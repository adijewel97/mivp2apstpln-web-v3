CREATE OR REPLACE EDITIONABLE PACKAGE  BODY                USERADISMONLAP.VER_PROSES_MIV AS
--CREATE OR REPLACE EDITIONABLE PACKAGE  BODY  USERADISMONLAP.VER_PROSES_MIV AS
--  Proses FILE RCN POSPAID MIV BANK
    PROCEDURE InsertRCNPost(vjson_data CLOB, vapp_userid in varchar2, out_cursor out SYS_REFCURSOR, pesan out VARCHAR)as 
        zidkirim            VARCHAR2(60);
        vCounter_sukses     INTEGER := 0;
        vCounter_gagal      INTEGER := 0;
        vCounter_all        INTEGER := 0;
        vROW_COUNT          INTEGER := 0;
        vNOUSULAN           VARCHAR2(21);
        vTGLUSULAN          VARCHAR2(8);
        vNAMAFILE           VARCHAR2(50);
        vRPTAG              NUMBER(12,2) := 0;
        vKET                VARCHAR2(50) := '';
    BEGIN
        zidkirim := sys_guid();
        pesan    := 'Gagal Data Insert FILE RCN Ke DB.';
        FOR REC IN (
             SELECT J.NOUSULAN, J.TGLUSULAN, J.VA, J.KDBANK, J.IDPEL, J.BLTH,
                    J.RPTAG, J.RPBK, J.USERID, J.TGLBAYAR, J.JAMBAYAR, J.NAMAFILE
               FROM JSON_TABLE(vjson_data, '$.items[*]' COLUMNS 
                 NOUSULAN    VARCHAR2(20)        PATH '$.NOUSULAN'
                ,TGLUSULAN   VARCHAR2(8)         PATH '$.TGLUSULAN'
                ,VA          VARCHAR2(20)        PATH '$.VA'
                ,KDBANK      VARCHAR2(3)         PATH '$.KDBANK'
                ,IDPEL       VARCHAR2(12)        PATH '$.IDPEL'
                ,BLTH        VARCHAR2(6)         PATH '$.BLTH'
                ,RPTAG       NUMBER(12)          PATH '$.RPTAG'
                ,RPBK        NUMBER(12)          PATH '$.RPBK'
                ,TGLBAYAR    VARCHAR2(10)        PATH '$.TGLBAYAR'
                ,JAMBAYAR    VARCHAR2(6)         PATH '$.JAMBAYAR'
                ,USERID      VARCHAR2(25)        PATH '$.USERID'
                ,NAMAFILE    VARCHAR2(50)        PATH '$.NAMAFILE'
               ) J
            ) 
            LOOP
                vNOUSULAN  := REC.NOUSULAN;
                vTGLUSULAN := REC.TGLUSULAN;
                vNAMAFILE  := REC.NAMAFILE;
                vCounter_all := vCounter_all + 1;
                
                SELECT COUNT(*) INTO vROW_COUNT
                FROM VER_DATA_LOCKING_BANK
                WHERE NOUSULAN = REC.NOUSULAN
                AND   TGLUSULAN= REC.TGLUSULAN   AND   VA       = REC.VA
                AND   KDBANK   = REC.KDBANK      AND   IDPEL    = REC.IDPEL
                AND   BLTH     = REC.BLTH;
                                         
                IF NVL(vROW_COUNT,0) = 0 THEN 
                    -- insert data RCN KE DB
                    INSERT INTO VER_DATA_LOCKING_BANK(NOUSULAN, TGLUSULAN, VA, KDBANK, IDPEL, BLTH, RPTAG, RPBK, TGLBAYAR, JAMBAYAR, USERID, NAMAFILE, TGLINSERT)
                    VALUES (REC.NOUSULAN, REC.TGLUSULAN, REC.VA, REC.KDBANK, REC.IDPEL, REC.BLTH, REC.RPTAG, REC.RPBK, REC.TGLBAYAR, TO_NUMBER(REC.JAMBAYAR), REC.USERID, REC.NAMAFILE, SYSDATE);
                    COMMIT;
                    vRPTAG  :=  vRPTAG + REC.RPTAG;
                    vCounter_sukses := vCounter_sukses + 1;
                ELSE
--                    INSERT INTO VER_DATA_LOCKING_BANK_ALL_LOG(NOUSULAN, TGLUSULAN, VA, KDBANK, IDPEL, BLTH, RPTAG, TGLBAYAR, JAMBAYAR, USERID, NAMAFILE, TGLINSERT)
--                    VALUES (REC.NOUSULAN, REC.TGLUSULAN, REC.VA, REC.KDBANK, REC.IDPEL, trim(REC.BLTH), REC.RPTAG, REC.TGLBAYAR, TO_NUMBER(REC.JAMBAYAR), REC.USERID, REC.NAMAFILE, SYSDATE);
--                    COMMIT;
                    vCounter_gagal  := vCounter_gagal + 1;
                END IF;           
            END LOOP;            
            
            vKET    := 'Sukses Insert = '||vCounter_sukses||', Gagal = '||vCounter_gagal||' Total = '||vCounter_all;
            -- insert data log
            INSERT INTO VER_RCN_BANK_LOG( IDKIRIM, NOUSULAN, TGLUSULAN, JML_SUKSES, JML_GAGAL, RPTAG, KET, USERID, NAMAFILE, TGLINSERT)
            VALUES (zidkirim, vNOUSULAN, vTGLUSULAN, vCounter_sukses, vCounter_gagal, vRPTAG, vKET, vapp_userid, vNAMAFILE, sysdate);
            COMMIT;
            
            open out_cursor for 
                select NAMAFILE, TGLINSERT TGLPROSES, KET, USERID
                from VER_RCN_BANK_LOG a
                where to_char(TGLINSERT,'YYYYMMDD') = to_char(sysdate,'YYYYMMDD')
                and USERID    = vapp_userid
                order by TGLINSERT desc;            
            pesan := 'Sukses Data Sudah Insert jumalah Sukses = '||vCounter_sukses||', Gagal = '||vCounter_gagal||', Dari Total = '||vCounter_all;
    EXCEPTION
        WHEN OTHERS THEN
        pesan := 'Gagal Proses Data ' || SQLERRM || DBMS_UTILITY.FORMAT_ERROR_BACKTRACE;
    END;
    
    PROCEDURE InsertRCNCTLPost(vjson_data CLOB, vapp_userid in varchar2, out_cursor out SYS_REFCURSOR, pesan out VARCHAR) as 
        zidkirim            VARCHAR2(60);
        vCounter_sukses     INTEGER := 0;
        vCounter_gagal      INTEGER := 0;
        vCounter_all        INTEGER := 0;
        vROW_COUNT          INTEGER := 0;
        vNAMAFILE           VARCHAR2(50);
        vLEMBAR             INTEGER(20);
        vRPTAG              NUMBER(12,2) := 0;
        vKET                VARCHAR2(50) := '';
    BEGIN
        zidkirim := sys_guid();
        pesan    := 'Gagal Data Insert FILE RCN Ke DB.';
        FOR REC IN (
             SELECT J.NAMAFILE, J.LEMBAR, J.RPTAG
               FROM JSON_TABLE(vjson_data, '$.items[*]' COLUMNS 
                 NAMAFILE    VARCHAR2(50)        PATH '$.NAMAFILE'
                ,LEMBAR      INTEGER             PATH '$.LEMBAR'
                ,RPTAG       NUMBER(12,2)        PATH '$.RPTAG'         
               ) J
            ) 
            LOOP
                vNAMAFILE  := REC.NAMAFILE;
                vCounter_all := vCounter_all + 1;
                
                SELECT COUNT(*) INTO vROW_COUNT
                FROM VER_DATA_LOCKING_BANK_CTL
                WHERE NAMAFILE = REC.NAMAFILE;
                                         
                IF NVL(vROW_COUNT,0) = 0 THEN 
                    -- insert data RCN KE DB
                    INSERT INTO VER_DATA_LOCKING_BANK_CTL(NAMAFILE, LEMBAR, RPTAG)
                    VALUES (REC.NAMAFILE, REC.LEMBAR, REC.RPTAG);
                    COMMIT;
                    vRPTAG := vRPTAG + REC.RPTAG;
                    vCounter_sukses := vCounter_sukses + 1;
                ELSE
                    vCounter_gagal  := vCounter_gagal + 1;
                END IF;           
            END LOOP;            
            
            vKET    := 'Sukses Insert = '||vCounter_sukses||', Gagal = '||vCounter_gagal||' Total = '||vCounter_all;--||' / '|| to_char(vRPTAG,'999,999,999,999');
            -- insert data log
            INSERT INTO VER_RCN_BANK_LOG( IDKIRIM, NOUSULAN, TGLUSULAN, JML_SUKSES, JML_GAGAL, RPTAG, KET, USERID, NAMAFILE, TGLINSERT)
            VALUES (zidkirim, null, null, vCounter_sukses, vCounter_gagal, vRPTAG, vKET, vapp_userid, vNAMAFILE, sysdate);
            COMMIT;
            
            open out_cursor for 
                select a.NAMAFILE, a.TGLINSERT TGLPROSES, a.KET||' / RPTAG = '||to_char(nvl(a.RPTAG,b.RPTAG),'999G999G999G999') KET, b.LEMBAR, b.RPTAG, a.USERID
                from VER_RCN_BANK_LOG a, VER_DATA_LOCKING_BANK_CTL b
                where to_char(a.TGLINSERT,'YYYYMMDD') = to_char(sysdate,'YYYYMMDD')
                and a.NAMAFILE = B.NAMAFILE(+)
                order by a.TGLINSERT desc;          
            pesan := 'Sukses Data Sudah Insert jumalah Sukses = '||vCounter_sukses||', Gagal = '||vCounter_gagal||', Dari Total = '||vCounter_all;
    EXCEPTION
        WHEN OTHERS THEN
        pesan := 'Gagal Proses Data ' || SQLERRM || DBMS_UTILITY.FORMAT_ERROR_BACKTRACE;
    END;
--  Proses FILE RCN PREPAID MIV BANK    
    PROCEDURE InsertRCNPre(vjson_data CLOB, vapp_userid in varchar2, out_cursor out SYS_REFCURSOR, pesan out VARCHAR)as 
        zidkirim            VARCHAR2(60);
        vCounter_sukses     INTEGER := 0;
        vCounter_gagal      INTEGER := 0;
        vCounter_all        INTEGER := 0;
        vROW_COUNT          INTEGER := 0;
        vNOUSULAN           VARCHAR2(20);
        vTGLUSULAN          VARCHAR2(8);
        vNAMAFILE           VARCHAR2(50);
        vRPTAG              NUMBER(12,2) := 0;
        vKET                VARCHAR2(50) := '';
    BEGIN
        zidkirim := sys_guid();
        pesan    := 'Gagal Data Insert FILE RCN Ke DB.';
        FOR REC IN (
                    SELECT J.NOUSULAN, J.TGLUSULAN, J.VA, J.KDBANK, J.IDPEL, J.BLTH,
                        J.RPTAG, J.RPBK, J.USERID, J.TGLBAYAR, J.JAMBAYAR, J.NAMAFILE
                    FROM JSON_TABLE(vjson_data, '$.items[*]' COLUMNS 
                         NOUSULAN    VARCHAR2(20)        PATH '$.NOUSULAN'
                        ,TGLUSULAN   VARCHAR2(8)         PATH '$.TGLUSULAN'
                        ,VA          VARCHAR2(20)        PATH '$.VA'
                        ,KDBANK      VARCHAR2(3)         PATH '$.KDBANK'
                        ,IDPEL       VARCHAR2(12)        PATH '$.IDPEL'
                        ,BLTH        VARCHAR2(6)         PATH '$.BLTH'
                        ,RPTAG       NUMBER(12)          PATH '$.RPTAG'
                        ,RPBK        NUMBER(12)          PATH '$.RPBK'
                        ,TGLBAYAR    VARCHAR2(10)        PATH '$.TGLBAYAR'
                        ,JAMBAYAR    VARCHAR2(6)         PATH '$.JAMBAYAR'
                        ,USERID      VARCHAR2(25)        PATH '$.USERID'
                        ,NAMAFILE    VARCHAR2(50)        PATH '$.NAMAFILE'
               ) J
            ) 
            LOOP
                vNOUSULAN  := REC.NOUSULAN;
                vTGLUSULAN := REC.TGLUSULAN;
                vNAMAFILE  := REC.NAMAFILE;
                vCounter_all := vCounter_all + 1;
                
                SELECT COUNT(*) INTO vROW_COUNT
                FROM VER_DATA_LOCKING_BANK_PRE
                WHERE NOUSULAN = REC.NOUSULAN
                AND   TGLUSULAN= REC.TGLUSULAN   AND   VA       = REC.VA
                AND   KDBANK   = REC.KDBANK      AND   IDPEL    = REC.IDPEL
                AND   BLTH     = trim(REC.BLTH);
                                         
                IF NVL(vROW_COUNT,0) = 0 THEN 
                    -- insert data RCN KE DB
                    INSERT INTO VER_DATA_LOCKING_BANK_PRE(NOUSULAN, TGLUSULAN, VA, KDBANK, IDPEL, BLTH, RPTAG, TGLBAYAR, JAMBAYAR, USERID, NAMAFILE, TGLINSERT)
                    VALUES (REC.NOUSULAN, REC.TGLUSULAN, REC.VA, REC.KDBANK, REC.IDPEL, trim(REC.BLTH), REC.RPTAG, REC.TGLBAYAR, TO_NUMBER(REC.JAMBAYAR), REC.USERID, REC.NAMAFILE, SYSDATE);
                    COMMIT;
                    vRPTAG  :=  vRPTAG + REC.RPTAG;
                    vCounter_sukses := vCounter_sukses + 1;
                ELSE 
--                    INSERT INTO VER_DATA_LOCKING_BANK_ALL_LOG(NOUSULAN, TGLUSULAN, VA, KDBANK, IDPEL, BLTH, RPTAG, TGLBAYAR, JAMBAYAR, USERID, NAMAFILE, TGLINSERT)
--                    VALUES (REC.NOUSULAN, REC.TGLUSULAN, REC.VA, REC.KDBANK, REC.IDPEL, trim(REC.BLTH), REC.RPTAG, REC.TGLBAYAR, TO_NUMBER(REC.JAMBAYAR), REC.USERID, REC.NAMAFILE, SYSDATE);
--                    COMMIT;
                    vCounter_gagal  := vCounter_gagal + 1;
                END IF;           
            END LOOP;            
            
            vKET    := 'Sukses Insert = '||vCounter_sukses||', Gagal = '||vCounter_gagal||' Total = '||vCounter_all;
            -- insert data log
            INSERT INTO VER_RCN_BANK_LOG( IDKIRIM, NOUSULAN, TGLUSULAN, JML_SUKSES, JML_GAGAL, RPTAG, KET, USERID, NAMAFILE, TGLINSERT)
            VALUES (zidkirim, vNOUSULAN, vTGLUSULAN, vCounter_sukses, vCounter_gagal, vRPTAG, vKET, vapp_userid, vNAMAFILE, sysdate);
            COMMIT;
            
            open out_cursor for 
                select NAMAFILE, TGLINSERT TGLPROSES, KET, USERID
                from VER_RCN_BANK_LOG a
                where to_char(TGLINSERT,'YYYYMMDD') = to_char(sysdate,'YYYYMMDD')
                and USERID    = vapp_userid
                order by TGLINSERT desc;            
            pesan := 'Sukses Data Sudah Insert jumalah Sukses = '||vCounter_sukses||', Gagal = '||vCounter_gagal||', Dari Total = '||vCounter_all;
    EXCEPTION
        WHEN OTHERS THEN
        pesan := 'Gagal Proses Data ' || SQLERRM || DBMS_UTILITY.FORMAT_ERROR_BACKTRACE;
        open out_cursor for 
            select NAMAFILE, TGLINSERT TGLPROSES, KET, USERID
            from VER_RCN_BANK_LOG a
            where to_char(TGLINSERT,'YYYYMMDD') = to_char(sysdate,'YYYYMMDD')
            and USERID    = vapp_userid
            order by TGLINSERT desc;    
    END;
    
    PROCEDURE InsertRCNCTLPre(vjson_data CLOB, vapp_userid in varchar2, out_cursor out SYS_REFCURSOR, pesan out VARCHAR) as 
        zidkirim            VARCHAR2(60);
        vCounter_sukses     INTEGER := 0;
        vCounter_gagal      INTEGER := 0;
        vCounter_all        INTEGER := 0;
        vROW_COUNT          INTEGER := 0;
        vNAMAFILE           VARCHAR2(50);
        vLEMBAR             INTEGER(20);
        vRPTAG              NUMBER(12,2) := 0;
        vKET                VARCHAR2(50) := '';
    BEGIN
        zidkirim := sys_guid();
        pesan    := 'Gagal Data Insert FILE RCN Ke DB.';
        FOR REC IN (
             SELECT J.NAMAFILE, J.LEMBAR, J.RPTAG
               FROM JSON_TABLE(vjson_data, '$.items[*]' COLUMNS 
                 NAMAFILE    VARCHAR2(50)        PATH '$.NAMAFILE'
                ,LEMBAR      INTEGER             PATH '$.LEMBAR'
                ,RPTAG       NUMBER(12,2)        PATH '$.RPTAG'         
               ) J
            ) 
            LOOP
                vNAMAFILE  := REC.NAMAFILE;
                vCounter_all := vCounter_all + 1;
                
                SELECT COUNT(*) INTO vROW_COUNT
                FROM VER_DATA_LOCKING_BANK_PRE_CTL
                WHERE NAMAFILE = REC.NAMAFILE;
                                         
                IF NVL(vROW_COUNT,0) = 0 THEN 
                    -- insert data RCN KE DB
                    INSERT INTO VER_DATA_LOCKING_BANK_PRE_CTL(NAMAFILE, LEMBAR, RPTAG)
                    VALUES (REC.NAMAFILE, REC.LEMBAR, REC.RPTAG);
                    COMMIT;
                    vRPTAG := vRPTAG + REC.RPTAG;
                    vCounter_sukses := vCounter_sukses + 1;
                ELSE
                    vCounter_gagal  := vCounter_gagal + 1;
                END IF;           
            END LOOP;            
            
            vKET    := 'Sukses Insert = '||vCounter_sukses||', Gagal = '||vCounter_gagal||' Total = '||vCounter_all;--||' / '|| to_char(vRPTAG,'999,999,999,999');
            -- insert data log
            INSERT INTO VER_RCN_BANK_LOG( IDKIRIM, NOUSULAN, TGLUSULAN, JML_SUKSES, JML_GAGAL, RPTAG, KET, USERID, NAMAFILE, TGLINSERT)
            VALUES (zidkirim, null, null, vCounter_sukses, vCounter_gagal, vRPTAG, vKET, vapp_userid, vNAMAFILE, sysdate);
            COMMIT;
            
            open out_cursor for 
                select a.NAMAFILE, a.TGLINSERT TGLPROSES, a.KET||' / RPTAG = '||to_char(nvl(a.RPTAG,b.RPTAG),'999G999G999G999') KET, b.LEMBAR, b.RPTAG, a.USERID
                from VER_RCN_BANK_LOG a, VER_DATA_LOCKING_BANK_PRE_CTL b
                where to_char(a.TGLINSERT,'YYYYMMDD') = to_char(sysdate,'YYYYMMDD')
                and a.NAMAFILE = B.NAMAFILE(+)
                order by a.TGLINSERT desc;          
            pesan := 'Sukses Data Sudah Insert jumalah Sukses = '||vCounter_sukses||', Gagal = '||vCounter_gagal||', Dari Total = '||vCounter_all;
    EXCEPTION
        WHEN OTHERS THEN
        pesan := 'Gagal Proses Data ' || SQLERRM || DBMS_UTILITY.FORMAT_ERROR_BACKTRACE;
    END;
--  Proses FILE RCN NONTAGLIS MIV BANK    
    PROCEDURE InsertRCNNtl(vjson_data CLOB, vapp_userid in varchar2, out_cursor out SYS_REFCURSOR, pesan out VARCHAR)as 
        zidkirim            VARCHAR2(60);
        vCounter_sukses     INTEGER := 0;
        vCounter_gagal      INTEGER := 0;
        vCounter_all        INTEGER := 0;
        vROW_COUNT          INTEGER := 0;
        vNOUSULAN           VARCHAR2(20);
        vTGLUSULAN          VARCHAR2(8);
        vNAMAFILE           VARCHAR2(50);
        vRPTAG              NUMBER(12,2) := 0;
        vKET                VARCHAR2(50) := '';
    BEGIN
        zidkirim := sys_guid();
        pesan    := 'Gagal Data Insert FILE RCN Ke DB.';
        FOR REC IN (
                    SELECT J.NOUSULAN, J.TGLUSULAN, J.VA, J.KDBANK, J.IDPEL, J.BLTH,
                        J.RPTAG, J.RPBK, J.USERID, J.TGLBAYAR, J.JAMBAYAR, J.NAMAFILE
                    FROM JSON_TABLE(vjson_data, '$.items[*]' COLUMNS 
                         NOUSULAN    VARCHAR2(20)        PATH '$.NOUSULAN'
                        ,TGLUSULAN   VARCHAR2(8)         PATH '$.TGLUSULAN'
                        ,VA          VARCHAR2(20)        PATH '$.VA'
                        ,KDBANK      VARCHAR2(3)         PATH '$.KDBANK'
                        ,IDPEL       VARCHAR2(13)        PATH '$.IDPEL' --- idpel berubah jadi noreh var 12 ke 13
                        ,BLTH        VARCHAR2(6)         PATH '$.BLTH'
                        ,RPTAG       NUMBER(12)          PATH '$.RPTAG'
                        ,RPBK        NUMBER(12)          PATH '$.RPBK'
                        ,TGLBAYAR    VARCHAR2(10)        PATH '$.TGLBAYAR'
                        ,JAMBAYAR    VARCHAR2(6)         PATH '$.JAMBAYAR'
                        ,USERID      VARCHAR2(25)        PATH '$.USERID'
                        ,NAMAFILE    VARCHAR2(50)        PATH '$.NAMAFILE'
               ) J
            ) 
            LOOP
                vNOUSULAN  := REC.NOUSULAN;
                vTGLUSULAN := REC.TGLUSULAN;
                vNAMAFILE  := REC.NAMAFILE;
                vCounter_all := vCounter_all + 1;
                
                SELECT COUNT(*) INTO vROW_COUNT
                FROM VER_DATA_LOCKING_BANK_NTL
                WHERE NOUSULAN = REC.NOUSULAN
                AND   TGLUSULAN= REC.TGLUSULAN   AND   VA       = REC.VA
                AND   KDBANK   = REC.KDBANK      AND   NOREG    = REC.IDPEL;
--                AND   BLTH     = trim(REC.BLTH);
                                         
                IF NVL(vROW_COUNT,0) = 0 THEN 
                    -- insert data RCN KE DB
                    INSERT INTO VER_DATA_LOCKING_BANK_NTL(NOUSULAN, TGLUSULAN, VA, KDBANK, NOREG, RPTAG, TGLBAYAR, JAMBAYAR, USERID, NAMAFILE, TGLINSERT)
                    VALUES (REC.NOUSULAN, REC.TGLUSULAN, REC.VA, REC.KDBANK, REC.IDPEL, REC.RPTAG, REC.TGLBAYAR, TO_NUMBER(REC.JAMBAYAR), REC.USERID, REC.NAMAFILE, SYSDATE);
                    COMMIT;
                    vRPTAG  :=  vRPTAG + REC.RPTAG;
                    vCounter_sukses := vCounter_sukses + 1;
                ELSE 
--                    INSERT INTO VER_DATA_LOCKING_BANK_ALL_LOG(NOUSULAN, TGLUSULAN, VA, KDBANK, IDPEL, BLTH, RPTAG, TGLBAYAR, JAMBAYAR, USERID, NAMAFILE, TGLINSERT)
--                    VALUES (REC.NOUSULAN, REC.TGLUSULAN, REC.VA, REC.KDBANK, REC.IDPEL, null, REC.RPTAG, REC.TGLBAYAR, TO_NUMBER(REC.JAMBAYAR), REC.USERID, REC.NAMAFILE, SYSDATE);
--                    COMMIT;
                    vCounter_gagal  := vCounter_gagal + 1;
                END IF;           
            END LOOP;            
            
            vKET    := 'Sukses Insert = '||vCounter_sukses||', Gagal = '||vCounter_gagal||' Total = '||vCounter_all;
            -- insert data log
            INSERT INTO VER_RCN_BANK_LOG( IDKIRIM, NOUSULAN, TGLUSULAN, JML_SUKSES, JML_GAGAL, RPTAG, KET, USERID, NAMAFILE, TGLINSERT)
            VALUES (zidkirim, vNOUSULAN, vTGLUSULAN, vCounter_sukses, vCounter_gagal, vRPTAG, vKET, vapp_userid, vNAMAFILE, sysdate);
            COMMIT;
            
            open out_cursor for 
                select NAMAFILE, TGLINSERT TGLPROSES, KET, USERID
                from VER_RCN_BANK_LOG a
                where to_char(TGLINSERT,'YYYYMMDD') = to_char(sysdate,'YYYYMMDD')
                and USERID    = vapp_userid
                order by TGLINSERT desc;            
            pesan := 'Sukses Data Sudah Insert jumalah Sukses = '||vCounter_sukses||', Gagal = '||vCounter_gagal||', Dari Total = '||vCounter_all;
    EXCEPTION
        WHEN OTHERS THEN
        pesan := 'Gagal Proses Data ' || SQLERRM || DBMS_UTILITY.FORMAT_ERROR_BACKTRACE;
        open out_cursor for 
            select NAMAFILE, TGLINSERT TGLPROSES, KET, USERID
            from VER_RCN_BANK_LOG a
            where to_char(TGLINSERT,'YYYYMMDD') = to_char(sysdate,'YYYYMMDD')
            and USERID    = vapp_userid
            order by TGLINSERT desc;    
    END;
    
    PROCEDURE InsertRCNCTLNtl(vjson_data CLOB, vapp_userid in varchar2, out_cursor out SYS_REFCURSOR, pesan out VARCHAR) as 
        zidkirim            VARCHAR2(60);
        vCounter_sukses     INTEGER := 0;
        vCounter_gagal      INTEGER := 0;
        vCounter_all        INTEGER := 0;
        vROW_COUNT          INTEGER := 0;
        vNAMAFILE           VARCHAR2(50);
        vLEMBAR             INTEGER(20);
        vRPTAG              NUMBER(12,2) := 0;
        vKET                VARCHAR2(50) := '';
    BEGIN
        zidkirim := sys_guid();
        pesan    := 'Gagal Data Insert FILE RCN Ke DB.';
        FOR REC IN (
             SELECT J.NAMAFILE, J.LEMBAR, J.RPTAG
               FROM JSON_TABLE(vjson_data, '$.items[*]' COLUMNS 
                 NAMAFILE    VARCHAR2(50)        PATH '$.NAMAFILE'
                ,LEMBAR      INTEGER             PATH '$.LEMBAR'
                ,RPTAG       NUMBER(12,2)        PATH '$.RPTAG'         
               ) J
            ) 
            LOOP
                vNAMAFILE  := REC.NAMAFILE;
                vCounter_all := vCounter_all + 1;
                
                SELECT COUNT(*) INTO vROW_COUNT
                FROM VER_DATA_LOCKING_BANK_NTL_CTL
                WHERE NAMAFILE = REC.NAMAFILE;
                                         
                IF NVL(vROW_COUNT,0) = 0 THEN 
                    -- insert data RCN KE DB
                    INSERT INTO VER_DATA_LOCKING_BANK_NTL_CTL(NAMAFILE, LEMBAR, RPTAG)
                    VALUES (REC.NAMAFILE, REC.LEMBAR, REC.RPTAG);
                    COMMIT;
                    vRPTAG := vRPTAG + REC.RPTAG;
                    vCounter_sukses := vCounter_sukses + 1;
                ELSE
                    vCounter_gagal  := vCounter_gagal + 1;
                END IF;           
            END LOOP;            
            
            vKET    := 'Sukses Insert = '||vCounter_sukses||', Gagal = '||vCounter_gagal||' Total = '||vCounter_all;--||' / '|| to_char(vRPTAG,'999,999,999,999');
            -- insert data log
            INSERT INTO VER_RCN_BANK_LOG( IDKIRIM, NOUSULAN, TGLUSULAN, JML_SUKSES, JML_GAGAL, RPTAG, KET, USERID, NAMAFILE, TGLINSERT)
            VALUES (zidkirim, null, null, vCounter_sukses, vCounter_gagal, vRPTAG, vKET, vapp_userid, vNAMAFILE, sysdate);
            COMMIT;
            
            open out_cursor for 
                select a.NAMAFILE, a.TGLINSERT TGLPROSES, a.KET||' / RPTAG = '||to_char(nvl(a.RPTAG,b.RPTAG),'999G999G999G999') KET, b.LEMBAR, b.RPTAG, a.USERID
                from VER_RCN_BANK_LOG a, VER_DATA_LOCKING_BANK_PRE_CTL b
                where to_char(a.TGLINSERT,'YYYYMMDD') = to_char(sysdate,'YYYYMMDD')
                and a.NAMAFILE = B.NAMAFILE(+)
                order by a.TGLINSERT desc;          
            pesan := 'Sukses Data Sudah Insert jumalah Sukses = '||vCounter_sukses||', Gagal = '||vCounter_gagal||', Dari Total = '||vCounter_all;
    EXCEPTION
        WHEN OTHERS THEN
        pesan := 'Gagal Proses Data ' || SQLERRM || DBMS_UTILITY.FORMAT_ERROR_BACKTRACE;
    END;

-- -----------------------------------------------------------------------------
--  Proses KIRIM ULANG PERMOHONAN FILE TXT POSPAID MIV BANK (dikarnakan permintaan PBH/BANK GAGAL PROSES BANK)
    PROCEDURE FileTXTNamaPost(vnousulan varchar2, vtglfile date, out_cursor out SYS_REFCURSOR, pesan out VARCHAR) as 
    BEGIN
        pesan    := 'Gagal Membuat Nama FILE TXT MIV BANK.';
        
        open out_cursor for 
            --1a) nama file detail
            select distinct 
                   nousulan||'-'||to_char(vtglfile,'YYYYMMDD')||'-'||KDBANK|| 'CA01.txt' namafile_txt,
                   nousulan||'-'||to_char(vtglfile,'YYYYMMDD')||'-'||KDBANK|| 'CA01.txt.ctl' namafile_txt_ctl
            from  VER_TEMP_DATA_LOCKING
            where tglusulan >= to_char(add_months(vtglfile,-2),'YYYYMMDD')
            and nousulan = vnousulan
            and kdproses = '2';
        pesan := 'Sukses Data Sudah Generate Nama File *.TXT dan *.TXT.XTL';
    EXCEPTION
        WHEN OTHERS THEN
        pesan := 'Gagal Proses Data ' || SQLERRM || DBMS_UTILITY.FORMAT_ERROR_BACKTRACE;
    END;
    
    ------------------   
    PROCEDURE FileTXTDetailPost(vnousulan varchar2, vtglfile date, out_cursor out SYS_REFCURSOR, pesan out VARCHAR) as
    BEGIN
        pesan    := 'Gagal Membuat Data Detail File TXT.';
        
        open out_cursor for 
            --1b) isi data detail  452719161    137
            select data
            from
            (
                select 1 urut, 'IDPEL|BLTH|RPTAG|KOGOL |NAMA|VA'  data from dual
                union
                select 2 urut, a.IDPEL||'|'||a.BLTH||'|'||LPAD(a.RPTAG,12,'0')||'|'||substr(LTRIM(KOGOL),1,1)||'|'||RPAD(a.NAMA,25,' ')||
                '|'||b.va data
                from
                (
                    select *
                    from VER_TEMP_DATA_LOCKING a
                    where tglusulan >= to_char(add_months(vtglfile,-2),'YYYYMMDD')
                    and nousulan = vnousulan
                    and kdproses = '2' 
                ) b,  DPP a
                where b.idpel = a.idpel
                and    b.blth   = a.blth
                and a.praqtis = '1'
                and a.kdgerak in('11','12','13') 
                union
                select 3 urut,LPAD(count(*),12,'0')||'|'||LPAD('0',6,'0')||'|'||LPAD(sum(nvl(a.RPTAG,0)),12,'0')||'|0|'||LPAD('0',25,'0')||
                '|'||LPAD('0',16,'0') data
                from
                (
                    select *
                    from VER_TEMP_DATA_LOCKING a
                    where tglusulan >= to_char(add_months(vtglfile,-2),'YYYYMMDD')
                    and nousulan = vnousulan
                    and kdproses = '2' 
                ) b,  DPP a
                where b.idpel = a.idpel
                and    b.blth   = a.blth
                and a.praqtis = '1'
                and a.kdgerak in('11','12','13')
            );
        pesan := 'Sukses Data Detail Nama File *.TXT ';
    EXCEPTION
        WHEN OTHERS THEN
        pesan := 'Gagal Proses Data ' || SQLERRM || DBMS_UTILITY.FORMAT_ERROR_BACKTRACE;
    END;
    
    PROCEDURE FileTXTRekapPost(vnousulan varchar2, vtglfile date, out_cursor out SYS_REFCURSOR, pesan out VARCHAR) as
    BEGIN
        pesan    := 'Gagal Membuat Data Detail File TXT.';
        
        open out_cursor for 
            --1c) buat file control
            select LPAD(count(*),19,'0')||'|'||LPAD(sum(nvl(a.RPTAG,0)),12,'0') data
            from
            (
                select *
                from VER_TEMP_DATA_LOCKING a
                where tglusulan >= to_char(add_months(vtglfile,-2),'YYYYMMDD')
                and nousulan = vnousulan
                and kdproses = '2' 
            ) b,  DPP a
            where b.idpel = a.idpel
            and b.blth   = a.blth
            and a.praqtis = '1'
            and a.kdgerak in('11','12','13');
        pesan := 'Sukses Data Detail Nama File *.TXT ';
    EXCEPTION
        WHEN OTHERS THEN
        pesan := 'Gagal Proses Data ' || SQLERRM || DBMS_UTILITY.FORMAT_ERROR_BACKTRACE;
    END;
    
END VER_PROSES_MIV;
/