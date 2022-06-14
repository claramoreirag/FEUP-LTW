PRAGMA foreign_keys = ON;

DROP TABLE IF EXISTS users;
CREATE TABLE users (
  userid INTEGER PRIMARY KEY,
  name VARCHAR,
  username VARCHAR,
  password VARCHAR,
  profilePic VARCHAR,
  email VARCHAR,
  phoneNumber VARCHAR,
  bio VARCHAR
);

DROP TABLE IF EXISTS pet;
CREATE TABLE pet (
  ownerid VARCHAR REFERENCES users(userid),
  name VARCHAR,
  id INTEGER PRIMARY KEY,
  age INTEGER,
  pet_type VARCHAR,
  size CHAR,
  color VARCHAR,
  description TEXT,
  photo VARCHAR -- TODO: find way of having multiple photos for same pet
);


DROP TABLE IF EXISTS photo;
CREATE TABLE photo(
    source VARCHAR PRIMARY KEY,
    pet REFERENCES pet(id)
);

DROP TABLE IF EXISTS favorite;
CREATE TABLE favorite(
    user INTEGER REFERENCES users(userid),
    post INTEGER REFERENCES post(id),
    PRIMARY KEY(user,post)
);

DROP TABLE IF EXISTS post;
CREATE TABLE post(
  id INTEGER PRIMARY KEY,
  owner INTEGER REFERENCES users(userid),
  pet INTEGER REFERENCES pet(id),
  is_adopted BOOLEAN,
  adopt BOOLEAN,
  message VARCHAR,
  post_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


DROP TABLE IF EXISTS proposal;
CREATE TABLE proposal(
    postid INTEGER REFERENCES post(id),
    user INTEGER REFERENCES users(userid),
    message VARCHAR,
    accepted BOOLEAN,
    PRIMARY KEY(user,postid)
);

DROP TABLE IF EXISTS question;
CREATE TABLE question(
    id INTEGER PRIMARY KEY,
    postid INTEGER REFERENCES post(id),
    sender INTEGER REFERENCES users(userid),
    message VARCHAR,
    sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS answer;
CREATE TABLE answer(
    id INTEGER PRIMARY KEY,
    question REFERENCES question(id),
    postid INTEGER REFERENCES post(id),
    owner INTEGER REFERENCES users(id),
    sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    message VARCHAR
);


PRAGMA foreign_keys = ON;