select * from VER_MASTER_UNIT

select * from VER_MASTER_BANK

select * from  VER_TEMP_DATA_LOCKING
where kd_dist = '56'
and blth = '202410'

plngate.dpp@link_plngatepost

select * from  plngatepost.dpp
where kd_dist = '56'
and (idpel,blth) in
(
    select idpel,blth from  VER_TEMP_DATA_LOCKING
    where kd_dist = '56'
    and blth = '202410'
)

select * from  VER_TEMP_DATA_LOCKING_NTL
where kd_dist = '56'
and to_char(tglinsert,'YYYYMM') = '202410'

select *
from OLAP.transaksi_nontaglis
where nomor_registrasi in
(
    select noreg from  VER_TEMP_DATA_LOCKING_NTL
    where kd_dist = '56'
    and to_char(tglinsert,'YYYYMM') = '202410'
)


SELECT * FROM OLAP.h2h
WHERE (IDPEL,BLTH) IN
(
    select idpel,blth from  VER_TEMP_DATA_LOCKING
    where kd_dist = '56'
    and blth = '202410'
);

SELECT * FROM ver_data_locking_bank
WHERE (IDPEL,BLTH) IN
(
    select idpel,blth from  VER_TEMP_DATA_LOCKING
    where kd_dist = '56'
    and blth = '202410'
);

select * from ver_data_locking_bank_ntl
where noreg in
(
    select noreg from  VER_TEMP_DATA_LOCKING_NTL
    where kd_dist = '56'
    and to_char(tglinsert,'YYYYMM') = '202410'
)

select * from VER_TEMP_DATA_LOCKING_PRE
where kd_dist = '56'


select * from  olap.MASTER_DISTRIBUSI

select * from olap.TRANSAKSI_PREPAID
where idpel in
(
    select idpel from VER_TEMP_DATA_LOCKING_PRE
    where kd_dist = '56'
)


select * from ver_data_locking_bank_pre
where idpel in
(
    select idpel from VER_TEMP_DATA_LOCKING_PRE
    where kd_dist = '56'
)

select * from VER_TEMP_DATA_LOCKING_SAKTI
where kd_dist = '56'
and blth = '202410'

select * from olap.MASTER_BANK


select * from olap.MASTER_UNIT