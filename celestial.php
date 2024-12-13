-- Connect to PostgreSQL
do \c postgres

-- Create the 'universe' database
CREATE DATABASE universe;

-- Connect to the 'universe' database
\c universe

-- Create the 'galaxy' table
CREATE TABLE galaxy (
  galaxy_id SERIAL PRIMARY KEY,
  name VARCHAR(100) UNIQUE NOT NULL,
  galaxy_type TEXT NOT NULL,
  age_in_millions_of_years NUMERIC NOT NULL,
  has_life BOOLEAN NOT NULL,
  is_spherical BOOLEAN NOT NULL
);

-- Create the 'star' table
CREATE TABLE star (
  star_id SERIAL PRIMARY KEY,
  name VARCHAR(100) UNIQUE NOT NULL,
  galaxy_id INT REFERENCES galaxy(galaxy_id),
  star_type TEXT NOT NULL,
  age_in_millions_of_years NUMERIC NOT NULL,
  is_main_sequence BOOLEAN NOT NULL
);

-- Create the 'planet' table
CREATE TABLE planet (
  planet_id SERIAL PRIMARY KEY,
  name VARCHAR(100) UNIQUE NOT NULL,
  star_id INT REFERENCES star(star_id),
  planet_type TEXT NOT NULL,
  distance_from_star NUMERIC NOT NULL,
  has_life BOOLEAN NOT NULL,
  number_of_moons INT NOT NULL,
  size_category INT NOT NULL
);

-- Create the 'moon' table
CREATE TABLE moon (
  moon_id SERIAL PRIMARY KEY,
  name VARCHAR(100) UNIQUE NOT NULL,
  planet_id INT REFERENCES planet(planet_id),
  size_in_km NUMERIC NOT NULL,
  has_atmosphere BOOLEAN NOT NULL,
  orbit_time INT NOT NULL
);

-- Create the 'comet' table
CREATE TABLE comet (
  comet_id SERIAL PRIMARY KEY,
  name VARCHAR(100) UNIQUE NOT NULL,
  galaxy_id INT REFERENCES galaxy(galaxy_id),
  speed_km_per_s NUMERIC NOT NULL,
  has_tail BOOLEAN NOT NULL
);

-- Insert data into 'galaxy'
INSERT INTO galaxy (name, galaxy_type, age_in_millions_of_years, has_life, is_spherical)
VALUES 
  ('Milky Way', 'Spiral', 13600, TRUE, TRUE),
  ('Andromeda', 'Spiral', 10000, FALSE, TRUE),
  ('Triangulum', 'Spiral', 12000, FALSE, TRUE),
  ('Whirlpool', 'Spiral', 8000, FALSE, TRUE),
  ('Sombrero', 'Elliptical', 9000, FALSE, FALSE),
  ('Cartwheel', 'Ring', 11000, FALSE, FALSE);

-- Insert data into 'star'
INSERT INTO star (name, galaxy_id, star_type, age_in_millions_of_years, is_main_sequence)
VALUES
  ('Sun', 1, 'G-Type', 4600, TRUE),
  ('Proxima Centauri', 1, 'M-Type', 4500, FALSE),
  ('Sirius', 2, 'A-Type', 500, TRUE),
  ('Vega', 2, 'A-Type', 400, TRUE),
  ('Betelgeuse', 3, 'M-Type', 10000, FALSE),
  ('Rigel', 3, 'B-Type', 8000, FALSE);

-- Insert data into 'planet'
INSERT INTO planet (name, star_id, planet_type, distance_from_star, has_life, number_of_moons, size_category)
VALUES
  ('Earth', 1, 'Terrestrial', 1.0, TRUE, 1, 3),
  ('Mars', 1, 'Terrestrial', 1.5, FALSE, 2, 2),
  ('Jupiter', 1, 'Gas Giant', 5.2, FALSE, 4, 5),
  ('Kepler-22b', 2, 'Exoplanet', 600, FALSE, 0, 4),
  ('Alpha Centauri Bb', 2, 'Exoplanet', 1.2, FALSE, 0, 2),
  ('Sirius B I', 3, 'Exoplanet', 0.9, FALSE, 1, 2),
  ('Sirius B II', 3, 'Exoplanet', 1.3, FALSE, 1, 3),
  ('Vega I', 4, 'Gas Giant', 3.2, FALSE, 2, 5),
  ('Vega II', 4, 'Terrestrial', 1.8, FALSE, 1, 3),
  ('Betelgeuse I', 5, 'Exoplanet', 4.1, FALSE, 0, 4),
  ('Betelgeuse II', 5, 'Exoplanet', 2.9, FALSE, 0, 3),
  ('Rigel I', 6, 'Gas Giant', 2.5, FALSE, 3, 5);

-- Insert data into 'moon'
INSERT INTO moon (name, planet_id, size_in_km, has_atmosphere, orbit_time)
VALUES
  ('Moon', 1, 3474, FALSE, 27),
  ('Phobos', 2, 22.2, FALSE, 8),
  ('Deimos', 2, 12.4, FALSE, 30),
  ('Io', 3, 3643, TRUE, 43),
  ('Europa', 3, 3121, TRUE, 85),
  ('Ganymede', 3, 5268, TRUE, 172),
  ('Callisto', 3, 4820, TRUE, 400),
  ('Kepler Moon A', 4, 2000, FALSE, 100),
  ('Kepler Moon B', 4, 1800, FALSE, 200),
  ('Alpha Moon A', 5, 1700, FALSE, 300),
  ('Alpha Moon B', 5, 1500, FALSE, 400),
  ('Sirius Moon A', 6, 3000, FALSE, 50),
  ('Sirius Moon B', 7, 2500, FALSE, 70),
  ('Vega Moon A', 8, 2200, FALSE, 120),
  ('Vega Moon B', 9, 2100, FALSE, 150),
  ('Betelgeuse Moon A', 10, 3100, FALSE, 90),
  ('Betelgeuse Moon B', 11, 2800, FALSE, 110),
  ('Rigel Moon A', 12, 4000, FALSE, 95),
  ('Rigel Moon B', 12, 3800, FALSE, 140),
  ('Rigel Moon C', 12, 3600, FALSE, 160);

-- Insert data into 'comet'
INSERT INTO comet (name, galaxy_id, speed_km_per_s, has_tail)
VALUES
  ('Halley', 1, 70.56, TRUE),
  ('Hale-Bopp', 2, 44.72, TRUE),
  ('Encke', 1, 31.33, TRUE),
  ('Tempel 1', 3, 10.20, TRUE),
  ('Swift-Tuttle', 2, 59.55, TRUE);
