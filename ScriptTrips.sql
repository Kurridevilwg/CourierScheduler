CREATE TABLE regions (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    travel_time INT NOT NULL
);

CREATE TABLE couriers (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE trips (
    id SERIAL PRIMARY KEY,
    region_id INT NOT NULL,
    courier_id INT NOT NULL,
    departure_date DATE NOT NULL,
    arrival_date DATE NOT NULL,
    return_date DATE NOT NULL,
    FOREIGN KEY (region_id) REFERENCES regions(id),
    FOREIGN KEY (courier_id) REFERENCES couriers(id)
);

INSERT INTO regions (name, travel_time) VALUES 
('Санкт-Петербург', 2),
('Уфа', 3),
('Нижний Новгород', 1),
('Владимир', 1),
('Кострома', 2),
('Екатеринбург', 4),
('Ковров', 1),
('Воронеж', 2),
('Самара', 3),
('Астрахань', 5);

INSERT INTO couriers (name) VALUES 
('Алексей Игоревич Смирнов'),
('Виктор Сергеевич Иванов'),
('Ольга Владимировна Кузнецова'),
('Елена Петровна Соколова'),
('Иван Александрович Михайлов'),
('Мария Дмитриевна Попова'),
('Сергей Викторович Лебедев'),
('Анна Николаевна Козлова'),
('Дмитрий Павлович Новиков'),
('Татьяна Васильевна Морозова');
