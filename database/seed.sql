USE school_bus_tracking;
-- Optional demonstration records. Safe to run more than once.
INSERT INTO buses (plate_no, driver_name, capacity)
SELECT 'RAC 123 A', 'Demo Driver', 30
WHERE NOT EXISTS (SELECT 1 FROM buses WHERE plate_no='RAC 123 A');
INSERT INTO routes (name, origin, destination)
SELECT 'Kigali Morning Route', 'Kimironko', 'Kigali City Centre'
WHERE NOT EXISTS (SELECT 1 FROM routes WHERE name='Kigali Morning Route');
INSERT INTO trips (bus_id, route_id, start_time, status)
SELECT b.bus_id, r.route_id, DATE_ADD(NOW(), INTERVAL 1 HOUR), 'scheduled'
FROM buses b JOIN routes r ON r.name='Kigali Morning Route'
WHERE b.plate_no='RAC 123 A'
AND NOT EXISTS (SELECT 1 FROM trips t WHERE t.bus_id=b.bus_id AND t.route_id=r.route_id AND t.status IN ('scheduled','active'));
