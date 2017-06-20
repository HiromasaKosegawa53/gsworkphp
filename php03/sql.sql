INSERT INTO gs_user_table(
    id,name,email,memo,indate
)VALUES(
    NULL,'三好さん','test10@test','D',sysdate()
);

INSERT INTO gs_book_table(
    id,bookTitle,bookUrl,bookText,indate
)VALUES(
    NULL,'PHP本','http://php.jp','D',sysdate()
);

SELECT * FROM gs_user_table WHERE id = 1 OR id = 3 OR id = 5;

SELECT * FROM gs_user_table WHERE id >=4 AND id <= 8;

SELECT * FROM gs_book_table WHERE bookTitle LIKE 'PHP%';

SELECT * FROM gs_book_table ORDER BY indate ASC;

SELECT * FROM gs_book_table WHERE indate LIKE '2017-06%';

SELECT * FROM gs_book_table ORDER BY indate ASC LIMIT 5;

SELECT COUNT(bookTitle) FROM gs_book_table WHERE bookTitle LIKE '%PHP%';

UPDATE gs_user_table SET name = '変更後の名前' WHERE id = 1;

UPDATE gs_book_table SET bookTitle = 'RB' WHERE id = 7;

UPDATE gs_book_table SET bookTitle = 'PY' WHERE id = 3 OR id = 9;

UPDATE gs_book_table SET indate = NOW() WHERE id >=6 AND id <= 8;

UPDATE gs_book_table SET bookTitle = 'PHP&JS' WHERE bookTitle = 'JS本';

UPDATE gs_book_table SET bookText = '未入力' WHERE bookText = '';

DELETE FROM gs_book_table WHERE id = 3;