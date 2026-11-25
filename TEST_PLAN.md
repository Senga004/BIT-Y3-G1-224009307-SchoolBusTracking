# Test Plan — Online School Bus Tracking System

Run these tests after installing the project and creating an administrator. Mark each result Pass/Fail and attach screenshots for important successful and rejected actions.

| # | Test case | Steps / input | Expected result | Type |
|---|---|---|---|---|
| 1 | Admin login success | Enter the created admin username and correct password | Dashboard opens | Happy path |
| 2 | Invalid login | Enter wrong password | Error message; dashboard stays protected | Failure |
| 3 | Session protection | Open `admin.php` while logged out | Redirect to login | Security |
| 4 | Role protection | Sign in as parent and open `admin.php` | Access denied (HTTP 403) | Security |
| 5 | Create user | Admin creates parent with valid email and 8+ character password | User appears in users list | Happy path |
| 6 | Reject invalid user | Submit invalid email or short password | Validation message; no user added | Failure |
| 7 | Create bus | Enter unique plate, driver name and positive capacity | Bus appears in bus list | Happy path |
| 8 | Reject duplicate bus plate | Add a bus using an existing plate number | Save is rejected; existing bus remains | Failure |
| 9 | Update bus | Change driver name or capacity and click Update | New values are displayed | CRUD |
| 10 | Delete unused bus | Delete a bus not assigned to any trip | Bus is removed | CRUD |
| 11 | Create route | Enter route name, origin and destination | Route appears in route list | Happy path |
| 12 | Update/delete route | Edit a route; delete a route not used by a trip | Changes save; unused route is removed | CRUD |
| 13 | Create trip | Select existing bus and route, choose start time | Trip appears in trip list | Happy path |
| 14 | Reject invalid trip relation | Submit a nonexistent bus or route ID (tamper request) | Database foreign key rejects it | Failure |
| 15 | Change trip status | Set a scheduled trip to active | Status becomes active | Happy path |
| 16 | JSON live search | Parent searches using part of plate number or route name | Matching trips returned as JSON and shown | Async |
| 17 | GPS update | Driver selects active trip and allows browser location | Bus coordinates and update time are saved | Happy path |
| 18 | Invalid GPS coordinates | Send latitude 200 or longitude 300 to update endpoint | HTTP 422 and no coordinates saved | Failure |
| 19 | CSRF rejection | Submit a form or GPS request without a valid token | HTTP 419; no change made | Security |
| 20 | XSS output escaping | Use text such as `<script>alert(1)</script>` as a route name | Text is displayed harmlessly, script does not run | Security |

**Evidence to capture:** login/dashboard, admin create/update/delete, trip status, driver GPS success, parent map/search, and one invalid/unauthorized request.
