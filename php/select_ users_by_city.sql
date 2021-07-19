SELECT NAME,
(SELECT 
 COUNT(*)
 FROM users
 WHERE id IN (SELECT user_id FROM user_addresses WHERE city_id = cities.id AND user_id = users.id )) usuarios
FROM
    `cities`