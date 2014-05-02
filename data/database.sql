  CREATE TABLE blog (
      id int(11) NOT NULL auto_increment,
      title varchar(100) NOT NULL,
      text varchar(100) NOT NULL,
      PRIMARY KEY (id)
  );
  INSERT INTO blog (title, text)
      VALUES  ('Blog #1',  'Welcome to my first Blogpost');
  INSERT INTO blog (title, text)
      VALUES  ('Blog #2',  'Welcome to my second Blogpost');
  INSERT INTO blog (title, text)
      VALUES  ('Blog #3',  'Welcome to my third Blogpost');
  INSERT INTO blog (title, text)
      VALUES  ('Blog #4',  'Welcome to my fourth Blogpost');
  INSERT INTO blog (title, text)
      VALUES  ('Blog #5',  'Welcome to my fifth Blogpost');