CREATE OR REPLACE PACKAGE BODY VER_APP_MENU AS

  FUNCTION list_menu(vemiluser in varchar2, pesan out varchar2) RETURN SYS_REFCURSOR  as
   menu_cursor SYS_REFCURSOR;
  BEGIN
    pesan := 'Gagal  Tampilkan Data';
    OPEN menu_cursor FOR
        SELECT c.*, a.USERNAME 
        FROM USERADISMONLAP.VER_USERS a, USERADISMONLAP.VER_APP_ROLES b, USERADISMONLAP.VER_APP_LISTMENU c
        where (a.USERNAME = vemiluser or a.EMAIL = vemiluser)
        and   a.ROLE = b.ROLE(+)
        and   b.IDMENU = c.IDMENU(+)
        and   b.IDMENU = c.IDMENU(+);
    
    pesan := 'Sukses  Tampilkan Data';            
    RETURN menu_cursor;
    EXCEPTION
        WHEN NO_DATA_FOUND THEN
           pesan:='Gagal Tampilkan Data '||SQLERRM;
        WHEN OTHERS THEN
           pesan:='Gagal Tampilkan Data ' ||SQLERRM || DBMS_UTILITY.FORMAT_ERROR_BACKTRACE;
  END;

END VER_APP_MENU;

/
