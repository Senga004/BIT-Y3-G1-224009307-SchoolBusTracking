# Online School Bus Tracking System

**Student project:** No. 109 — Online School Bus Tracking System  
**Registration number:** 224009307

A beginner-friendly PHP, MySQL, HTML, CSS and vanilla JavaScript application. Parents can view active/scheduled trips and the latest GPS position shared by a driver. Administrators manage users, buses, routes and trips.

## Assignment requirements followed
- Four assigned database entities: `users`, `buses`, `routes`, `trips` (primary/foreign keys and InnoDB relationships).
- HTML5, CSS3 and responsive layout; vanilla JavaScript DOM/events and Fetch API.
- PHP sessions, shared includes, PDO prepared statements and separated `src/` logic.
- JSON API endpoints: `api/locations.php` (search + bus data) and `api/update_location.php` (GPS updates).
- Password hashing and verification; output escaping with `htmlspecialchars()`; CSRF tokens; server-side validation.
- Full CRUD for buses and routes; users and trips support create/read plus trip status updates.
- No Laravel, React, Vue or Bootstrap.

GPS coordinates are stored in nullable columns on `buses`, so the database retains the four assigned tables and does not introduce a fifth entity.

## Requirements
- XAMPP (Apache + MySQL) or PHP 8+ with PDO MySQL
- Modern browser; internet access is needed for OpenStreetMap/Leaflet map tiles
- Browser location permission for the driver GPS page. Geolocation normally requires HTTPS, except on `localhost`.

## Installation on XAMPP
1. Extract this ZIP.
2. Copy `online_school_bus_tracking` into `C:\xampp\htdocs\`.
3. Start **Apache** and **MySQL** in XAMPP Control Panel.
4. Open `http://localhost/phpmyadmin`.
5. Import `database/schema.sql` (select the file in the Import tab and click Import).
6. Optional: import `database/seed.sql` to add one sample bus, route and scheduled trip.
7. Open `http://localhost/online_school_bus_tracking/public/setup_admin.php`.
8. Create your own administrator username, email and password (minimum 10 characters).
9. **Delete `public/setup_admin.php` immediately after the first administrator is created.**
10. Open `http://localhost/online_school_bus_tracking/public/` and sign in.

Default XAMPP database settings are in `src/config.php`: host `localhost`, database `school_bus_tracking`, username `root`, blank password. Change these if your MySQL credentials differ.

## First use
1. Sign in as administrator and open Administration.
2. Create a driver and parent account.
3. Add a bus and a route, then create a trip.
4. Change the trip status to `active`.
5. Sign out and sign in using the driver account; open **Share GPS location**, select the active trip and allow location permission.
6. Sign in as a parent on another browser/device and open **Track a bus**. The page refreshes every 10 seconds and supports live search.

## Main pages / API routes
- `public/index.php` — login
- `public/dashboard.php` — role dashboard
- `public/admin.php` — admin management
- `public/driver.php` — driver GPS sharing
- `public/track.php` — parent/admin map and search
- `public/api/locations.php?q=...` — authenticated JSON search/list endpoint
- `public/api/update_location.php` — authenticated driver GPS update endpoint (POST JSON + CSRF header)

## Test evidence / test plan
See `TEST_PLAN.md`. Run the cases after importing the database and creating the first administrator. Record screenshots of successful login, admin CRUD, GPS update, parent map, and rejected invalid requests for your final submission.

## Security and project limitations
- Passwords are stored with `password_hash()` and checked with `password_verify()`.
- Database writes use PDO prepared statements; output is escaped; forms and GPS updates use CSRF tokens.
- Only admins can use administration; only drivers can submit GPS updates; login sessions are regenerated after login.
- This is an academic demonstration, not a production student-transport safety platform. Before real deployment add HTTPS, account recovery, audit logs, parent-to-student permissions, rate limiting, stronger role/assignment checks, backups and a trusted GPS device workflow.

## GitHub submission checklist
- Suggested repository name: `BIT-Y3-G1-224009307-SchoolBusTracking`
- Push the complete project folder, including `database/`, `src/`, `public/`, `README.md`, `TEST_PLAN.md` and `DEMO_GUIDE.md`.
- Add GitHub user `bemmy2005` as a repository collaborator (Settings → Collaborators).
- Submit the repository URL and a short project summary on the LMS.
- Record a 2–3 minute demo or prepare a live demonstration using `DEMO_GUIDE.md`.
