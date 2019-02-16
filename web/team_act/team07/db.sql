CREATE TABLE Users7(
    ID          SERIAL PRIMARY KEY,
    name        VARCHAR(100),
    pass        VARCHAR(80)

);


CREATE TABLE Session(
    ID          SERIAL PRIMARY KEY,
    users_ID    INT REFERENCES Users7(ID)
);
