# TODO: Adapt Slider to Display Articles

## Information Gathered
- Artikel model has 'photo' field for background images, stored in 'public/artikel/'.
- Dashboard controller's `dashboard_user` method fetches data for the user dashboard view.
- The view `resources/views/user/dashboard/user.blade.php` has a static slider section that needs to be made dynamic for articles.
- Articles are published via `status = 'published'`.
- No individual article detail route for users; link to `landing-artikel` for full list.

## Plan
1. **Modify Dashboard Controller**: Add fetching of latest published articles (e.g., take 3) in `dashboard_user` method.
2. **Update View**: Change the slider to loop through articles, using article photo as background, and display title, excerpt, category, with link to article landing page.

## Dependent Files to Edit
- `app/Http/Controllers/Dashboard.php` (add artikel fetching) - DONE
- `resources/views/user/dashboard/user.blade.php` (modify slider section) - DONE

## Followup Steps
- Test the dashboard view to ensure articles display correctly in the slider.
- Verify image paths and links work.
- If needed, adjust the number of articles displayed or styling.
