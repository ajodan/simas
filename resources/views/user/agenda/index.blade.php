@extends('user.layouts.layout')

@section('content')
    <section>
        <div class="gap black-layer opc7">
            <div class="fixed-bg2" style="background-image: url({{ asset('assets-landing/images/pg-tp-bg.jpg') }});"></div>
            <div class="container">
                <div class="pg-tp-wrp text-center">
                    <div class="pg-tp-inr">
                        <h1 itemprop="headline">Agenda Masjid Jami' Al Furqaan</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard-user') }}" title=""
                                    itemprop="url">Home</a></li>
                            <li class="breadcrumb-item active">Agenda</li>
                        </ol>
                    </div>
                </div><!-- Page Top Wrap -->
            </div>
        </div>
    </section>
    <section>
    <div class="container-fluid px-4 py-6">
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <button id="prev-month" data-month="{{ $currentMonth->copy()->subMonth()->month }}" data-year="{{ $currentMonth->copy()->subMonth()->year }}" class="btn btn-outline-secondary btn-sm">&laquo; Sebelumnya</button>
                <h2 id="current-month-title" class="h4 mb-0">{{ $currentMonth->format('F Y') }}</h2>
                <button id="next-month" data-month="{{ $currentMonth->copy()->addMonth()->month }}" data-year="{{ $currentMonth->copy()->addMonth()->year }}" class="btn btn-outline-secondary btn-sm">Berikutnya &raquo;</button>
            </div>

            <div id="loading-indicator" class="text-center py-4 d-none">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2 text-muted">Memuat...</p>
            </div>
        </div>
    </div>
    </div>
    </section>

<div id="calendar-container" class="mb-3">
    <style>
        .calendar-grid {
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            overflow: hidden;
        }
        .calendar-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }
        .calendar-week {
            border-bottom: 1px solid #dee2e6;
        }
        .calendar-week:last-child {
            border-bottom: none;
        }
        .calendar-day {
            border-right: 1px solid #dee2e6;
            aspect-ratio: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding: 0.5rem;
        }
        .calendar-day:last-child {
            border-right: none;
        }
        .calendar-day:hover {
            background-color: #f8f9fa !important;
        }
        .event-container {
            width: 100%;
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.25rem;
        }
    </style>
    {!! $calendarHtml !!}
</div>

            <div class="mt-3 small text-muted">
                <strong>Legenda:</strong> Kotak biru menunjukkan acara pada hari tersebut. Klik tanggal untuk detail.
            </div>
    </div>

    <!-- Modal for agenda details -->
    <div class="modal fade" id="agendaDetailModal" tabindex="-1" aria-labelledby="agendaDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agendaDetailModalLabel">Detail Agenda</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul id="agenda-detail-list" class="list-group list-group-flush">
                        <!-- Agenda details will be loaded here -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const calendarContainer = document.getElementById('calendar-container');
        const loadingIndicator = document.getElementById('loading-indicator');
        const currentMonthTitle = document.getElementById('current-month-title');
        const agendaDetailModal = new bootstrap.Modal(document.getElementById('agendaDetailModal'));
        const agendaDetailList = document.getElementById('agenda-detail-list');

        function showLoading() {
            loadingIndicator.classList.remove('d-none');
            calendarContainer.classList.add('opacity-50');
        }

        function hideLoading() {
            loadingIndicator.classList.add('d-none');
            calendarContainer.classList.remove('opacity-50');
        }

        function updateNavigationButtons(month, year) {
            const prevMonthBtn = document.getElementById('prev-month');
            const nextMonthBtn = document.getElementById('next-month');

            const prevDate = new Date(year, month - 2, 1); // JS months 0-based
            const nextDate = new Date(year, month, 1);

            prevMonthBtn.dataset.month = prevDate.getMonth() + 1;
            prevMonthBtn.dataset.year = prevDate.getFullYear();

            nextMonthBtn.dataset.month = nextDate.getMonth() + 1;
            nextMonthBtn.dataset.year = nextDate.getFullYear();
        }

        function fetchCalendar(month, year) {
            showLoading();
            fetch(`{{ route('agenda') }}?month=${month}&year=${year}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                calendarContainer.innerHTML = data.calendar;
                currentMonthTitle.textContent = data.month;
                updateNavigationButtons(month, year);
            })
            .catch(() => {
                alert('Terjadi kesalahan saat memuat kalender. Silakan coba lagi.');
            })
            .finally(() => {
                hideLoading();
            });
        }

        document.getElementById('prev-month').addEventListener('click', function () {
            const month = this.dataset.month;
            const year = this.dataset.year;
            fetchCalendar(month, year);
        });

        document.getElementById('next-month').addEventListener('click', function () {
            const month = this.dataset.month;
            const year = this.dataset.year;
            fetchCalendar(month, year);
        });

        calendarContainer.addEventListener('click', function (e) {
            const target = e.target.closest('button[data-date]');
            if (!target) return;

            const date = target.dataset.date;
            if (!date) return;

            agendaDetailList.innerHTML = '';
            document.getElementById('agendaDetailModalLabel').textContent = 'Detail Agenda - ' + date;

            fetch(`{{ route('agenda.get-by-date') }}?date=${date}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const agendas = data.data;
                        if (agendas.length > 0) {
                            agendas.forEach(agenda => {
                                const li = document.createElement('li');
                                li.className = 'list-group-item';
                                li.innerHTML = `<h6 class="fw-bold">${agenda.judul}</h6><p class="mb-0">${agenda.deskripsi}</p>`;
                                agendaDetailList.appendChild(li);
                            });
                        } else {
                            const li = document.createElement('li');
                            li.className = 'list-group-item';
                            li.textContent = 'Tidak ada agenda pada tanggal ini.';
                            agendaDetailList.appendChild(li);
                        }
                        agendaDetailModal.show();
                    } else {
                        alert('Gagal mengambil data agenda.');
                    }
                })
                .catch(() => {
                    alert('Terjadi kesalahan saat mengambil data agenda.');
                });
        });

        // Keyboard navigation for calendar
        document.addEventListener('keydown', function (e) {
            if (e.key === 'ArrowLeft') {
                document.getElementById('prev-month').click();
            } else if (e.key === 'ArrowRight') {
                document.getElementById('next-month').click();
            }
        });
    });
</script>
@endsection
