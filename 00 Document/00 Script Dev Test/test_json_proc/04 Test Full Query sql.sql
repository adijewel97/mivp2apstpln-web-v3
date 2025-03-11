DECLARE
    v_json_data CLOB := '[{"column1": "value1", "column2": "value2", "column3": "value3"},
                          {"column1": "value4", "column2": "value5", "column3": "value6"}]';
BEGIN
    FOR r IN (SELECT jt.column1, jt.column2, jt.column3
              FROM JSON_TABLE(v_json_data,
                              '$[*]' COLUMNS (
                                  column1 VARCHAR2(50) PATH '$.column1',
                                  column2 VARCHAR2(50) PATH '$.column2',
                                  column3 VARCHAR2(50) PATH '$.column3'
                              )) jt)
    LOOP
        DBMS_OUTPUT.PUT_LINE(r.column1 || ', ' || r.column2 || ', ' || r.column3);
    END LOOP;
END;
