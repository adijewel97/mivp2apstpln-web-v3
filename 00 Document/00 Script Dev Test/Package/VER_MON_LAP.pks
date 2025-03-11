CREATE OR REPLACE PACKAGE USERADISMONLAP.VER_MON_LAP IS
  PROCEDURE GET_combo_UNITUPI (out_cursor out SYS_REFCURSOR, pesan out VARCHAR);
  PROCEDURE GET_combo_UNITAP (vkd_dist in Varchar2,out_cursor out SYS_REFCURSOR, pesan out VARCHAR);
  PROCEDURE GET_combo_BANK_MIV (vkdbank in Varchar2,out_cursor out SYS_REFCURSOR, pesan out VARCHAR);
  PROCEDURE monlap_mivbelumflag_plnvsbank(vbln_usulan IN NUMBER, pilih in VARCHAR,  out_cursor out SYS_REFCURSOR, pesan out VARCHAR);
  PROCEDURE monlap_mivflag_plnvsbank_pusat(vbln_usulan IN NUMBER,  out_cursor out SYS_REFCURSOR, pesan out VARCHAR);
  PROCEDURE monlap_mivfalg_plnvsbank_uiw(vbln_usulan IN NUMBER, vkdbank in VARCHAR, vkddist in VARCHAR,vkdarea in VARCHAR, out_cursor out SYS_REFCURSOR, pesan out VARCHAR);
  PROCEDURE monlap_saktiStatus_UnPending_pusat(vbln_usulan IN NUMBER,  out_cursor out SYS_REFCURSOR, pesan out VARCHAR);
  PROCEDURE monlap_saktiDaftar_UnPending_pusat(vbln_usulan IN NUMBER, vkdgol in varchar2, vkdgerak in varchar2,vprqatis in varchar2, out_cursor out SYS_REFCURSOR, pesan out VARCHAR);
END VER_MON_LAP;