<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAgendaRequest;
use App\Http\Requests\UpdateAgendaRequest;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AgendaController extends BaseController
{
    private $daysOfWeek = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];

    public function index()
    {
        $module = 'Agenda';
        $month = request('month', now()->month);
        $year = request('year', now()->year);

        $currentMonth = \Carbon\Carbon::createFromDate($year, $month, 1);

        if (request()->ajax()) {
            $calendarHtml = $this->getCalendar($month, $year, false);
            return response()->json(['calendar' => $calendarHtml, 'month' => $currentMonth->format('F Y')]);
        }

        $agendas = $this->getAgendasForMonth($month, $year);
        $calendarHtml = $this->getCalendar($month, $year, false);

        return view('admin.agenda.index', compact('module', 'agendas', 'currentMonth', 'calendarHtml'));
    }

    public function get()
    {
        $agenda = Agenda::orderBy('tanggal', 'desc')->get();
        return $this->sendResponse($agenda, 'Get data success');
    }

    public function index_user(Request $request)
    {
        $module = 'Agenda';
        $month = $request->get('month', now()->month);
        $year = $request->get('year', now()->year);

        $currentMonth = \Carbon\Carbon::createFromDate($year, $month, 1);

        if ($request->ajax()) {
            $calendarHtml = $this->getCalendar($month, $year, true);
            return response()->json(['calendar' => $calendarHtml, 'month' => $currentMonth->format('F Y')]);
        }

        $agendas = $this->getAgendasForMonth($month, $year);
        $calendarHtml = $this->getCalendar($month, $year, true);

        return view('user.agenda.index', compact('agendas', 'module', 'currentMonth', 'calendarHtml'));
    }

    private function getAgendasForMonth($month, $year)
    {
        $currentMonth = \Carbon\Carbon::createFromDate($year, $month, 1);
        $startOfMonth = $currentMonth->copy()->startOfMonth();
        $endOfMonth = $currentMonth->copy()->endOfMonth();

        return Agenda::whereBetween('tanggal', [$startOfMonth, $endOfMonth])
            ->orderBy('tanggal', 'asc')
            ->get();
    }

    private function getCalendar($month, $year, $isUser = false)
    {
        $currentMonth = \Carbon\Carbon::createFromDate($year, $month, 1);
        $startOfMonth = $currentMonth->copy()->startOfMonth();
        $endOfMonth = $currentMonth->copy()->endOfMonth();
        $startDate = $startOfMonth->copy()->startOfWeek(\Carbon\Carbon::MONDAY);
        $endDate = $endOfMonth->copy()->endOfWeek(\Carbon\Carbon::SUNDAY);

        $agendas = $this->getAgendasForMonth($month, $year);

        if ($isUser) {
            return $this->generateUserCalendarHtml($startDate, $endDate, $currentMonth, $agendas);
        } else {
            return $this->generateAdminCalendarHtml($startDate, $endDate, $currentMonth, $agendas);
        }
    }

    private function generateDayHeaders()
    {
        $html = '';
        foreach ($this->daysOfWeek as $day) {
            $html .= '<div class="col text-center fw-bold text-muted py-3 bg-light rounded">' . $day . '</div>';
        }
        return $html;
    }

    private function generateUserCalendarHtml($startDate, $endDate, $currentMonth, $agendas)
    {
        $html = '<div class="calendar-grid">';
        $html .= '<div class="calendar-header row g-0">';
        $html .= $this->generateDayHeaders();
        $html .= '</div>';

        $html .= '<div class="calendar-body">';

        $weekCount = 0;
        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            if ($date->dayOfWeek == \Carbon\Carbon::MONDAY) {
                if ($weekCount > 0) {
                    $html .= '</div>';
                }
                $html .= '<div class="calendar-week row g-0">';
                $weekCount++;
            }
            $html .= $this->generateUserDateCell($date, $currentMonth, $agendas);
        }
        $html .= '</div>'; // Close last week row

        $html .= '</div></div>';
        return $html;
    }

    private function generateUserDateCell($date, $currentMonth, $agendas)
    {
        $events = $agendas->filter(function ($agenda) use ($date) {
            return \Carbon\Carbon::parse($agenda->tanggal)->toDateString() == $date->toDateString();
        });

        $isCurrentMonth = $date->month == $currentMonth->month;
        $isToday = $date->isToday();
        $hasEvents = $events->count() > 0;
        $baseClass = $isCurrentMonth ? 'bg-white' : 'bg-light';
        $eventClass = $hasEvents ? 'border-primary bg-primary bg-opacity-10' : 'border-secondary';
        $todayClass = $isToday ? 'bg-warning bg-opacity-25 border-warning' : '';
        $class = 'border ' . $baseClass . ' ' . $eventClass . ' ' . $todayClass . ' calendar-day';

        $html = '<div class="col ' . $class . ' p-2 text-center position-relative" style="min-height: 120px; transition: all 0.2s;" data-date="' . $date->toDateString() . '">';
        $html .= '<div class="fw-bold mb-2 ' . ($isToday ? 'text-warning' : '') . '">' . $date->day . '</div>';
        $html .= '<div class="event-container">';

        $displayedEvents = $events->take(2);
        foreach ($displayedEvents as $agenda) {
            $html .= '<div class="badge bg-primary text-truncate d-block mb-1 small" title="' . $agenda->judul . ' : ' . $agenda->deskripsi . '" style="font-size: 1rem;">';
            $html .= Str::limit($agenda->judul, 64);
            $html .= '</div>';
        }

        if ($events->count() > 2) {
            $remaining = $events->count() - 2;
            $html .= '<div class="badge bg-secondary text-truncate d-block mb-1 small" style="font-size: 0.75rem;">+' . $remaining . ' more</div>';
        }

        // if ($hasEvents) {
        //     $html .= '<button class="btn btn-primary btn-sm mt-1" data-date="' . $date->toDateString() . '" style="font-size: 0.7rem;">Detail Agenda</button>';
        // }

        $html .= '</div>';
        if ($isToday) {
            $html .= '<div class="position-absolute top-0 end-0 badge bg-warning text-dark small" style="font-size: 0.6rem;">Today</div>';
        }
        $html .= '</div>';

        return $html;
    }

    private function generateAdminCalendarHtml($startDate, $endDate, $currentMonth, $agendas)
    {
        $html = '<table class="table table-bordered table-sm text-center mb-0"><thead class="table-light"><tr>';

        foreach ($this->daysOfWeek as $day) {
            $html .= '<th>' . $day . '</th>';
        }

        $html .= '</tr></thead><tbody><tr>';

        $weekDay = 0;
        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            $html .= $this->generateAdminDateCell($date, $currentMonth, $agendas);

            $weekDay++;
            if ($weekDay % 7 == 0) {
                $html .= '</tr><tr>';
            }
        }

        $html .= '</tr></tbody></table>';

        return $html;
    }

    private function generateAdminDateCell($date, $currentMonth, $agendas)
    {
        $events = $agendas->filter(function ($agenda) use ($date) {
            return \Carbon\Carbon::parse($agenda->tanggal)->toDateString() == $date->toDateString();
        });

        $isCurrentMonth = $date->month == $currentMonth->month;
        $class = $isCurrentMonth ? '' : 'bg-light';

        $html = '<td class="' . $class . ' align-top p-2" style="min-width:100px; cursor:pointer;" data-date="' . $date->toDateString() . '">';
        $html .= '<div class="fw-bold">' . $date->day . '</div>';

        foreach ($events as $agenda) {
            $html .= '<div class="badge bg-primary text-truncate d-block mb-1" title="' . $agenda->judul . ': ' . $agenda->deskripsi . '">';
            $html .= Str::limit($agenda->judul, 20);
            $html .= '</div>';
        }

        $html .= '</td>';

        return $html;
    }

    public function add(StoreAgendaRequest $request)
    {
        // Combine validated results
        $data = $request->validated();
        $agenda = Agenda::create($data);
        return $this->sendResponse($agenda, 'Tambah data berhasil');
    }

    public function show($params)
    {
        $data = array();
        try {
            $data = Agenda::where('uuid', $params)->first();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Show data success');
    }

    public function update(UpdateAgendaRequest $request, $params)
    {
        $data = Agenda::where('uuid', $params)->first();

        // Combine validated results
        $dataUpdate = $request->validated();

        Agenda::where('uuid', $params)->update($dataUpdate);
        return $this->sendResponse($dataUpdate, 'Perubahan data agenda berhasil');
    }

    public function delete($params)
    {
        $data = Agenda::where('uuid', $params)->first();
        if ($data) {
            $data->delete();
            return $this->sendResponse([], 'Data agenda berhasil dihapus');
        } else {
            return $this->sendError('Data not found', 'Data not found', 404);
        }
    }

    public function getByDate(Request $request)
    {
        $date = $request->get('date');
        $agendas = Agenda::where('tanggal', $date)->get();
        return $this->sendResponse($agendas, 'Get agendas by date success');
    }
}
