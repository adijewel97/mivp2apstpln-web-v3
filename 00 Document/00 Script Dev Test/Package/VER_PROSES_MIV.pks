CREATE OR REPLACE EDITIONABLE PACKAGE                 USERADISMONLAP.VER_PROSES_MIV AS
    PROCEDURE InsertRCNPost(vjson_data CLOB, vapp_userid in varchar2, out_cursor out SYS_REFCURSOR, pesan out VARCHAR);    
    PROCEDURE InsertRCNCTLPost(vjson_data CLOB, vapp_userid in varchar2, out_cursor out SYS_REFCURSOR, pesan out VARCHAR);    
    PROCEDURE InsertRCNCTLPre(vjson_data CLOB, vapp_userid in varchar2, out_cursor out SYS_REFCURSOR, pesan out VARCHAR);
    
--  Proses FILE RCN NONTAGLIS MIV BANK    
    PROCEDURE InsertRCNNtl(vjson_data CLOB, vapp_userid in varchar2, out_cursor out SYS_REFCURSOR, pesan out VARCHAR);    
    PROCEDURE InsertRCNCTLNtl(vjson_data CLOB, vapp_userid in varchar2, out_cursor out SYS_REFCURSOR, pesan out VARCHAR);

-- -----------------------------------------------------------------------------
--  Proses KIRIM ULANG PERMOHONAN FILE TXT POSPAID MIV BANK (dikarnakan permintaan PBH/BANK GAGAL PROSES BANK)
    PROCEDURE FileTXTNamaPost(vnousulan varchar2, vtglfile date, out_cursor out SYS_REFCURSOR, pesan out VARCHAR);    
    PROCEDURE FileTXTRekapPost(vnousulan varchar2, vtglfile date, out_cursor out SYS_REFCURSOR, pesan out VARCHAR);
    
END VER_PROSES_MIV;
/