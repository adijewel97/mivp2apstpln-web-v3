SELECT jt.column1, jt.column2, jt.column3
        FROM JSON_TABLE('[{"column1": "value1", "column2": "value2", "column3": "value3"},
                          {"column1": "value4", "column2": "value5", "column3": "value6"}]',
                        '$[*]' COLUMNS (
                            column1 VARCHAR2(50) PATH '$.column1',
                            column2 VARCHAR2(50) PATH '$.column2',
                            column3 VARCHAR2(50) PATH '$.column3'
                        )) jt