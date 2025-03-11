CREATE OR REPLACE PROCEDURE insert_data_proc (
    json_data IN CLOB
) AS
BEGIN
    FOR data_rec IN (SELECT * FROM JSON_TABLE(json_data, '$[*]'
                        COLUMNS (
                            column1 VARCHAR2(50) PATH '$.column1',
                            column2 VARCHAR2(50) PATH '$.column2',
                            column3 VARCHAR2(50) PATH '$.column3'
                        )
                    ) 
                    ) LOOP
        INSERT INTO your_table_name (column1, column2, column3)
        VALUES (data_rec.column1, data_rec.column2, data_rec.column3);
    END LOOP;
    COMMIT;
END;
/