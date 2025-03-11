select *
from ophartde.VER_TEMP_DATA_LOCKING
where to_char(TGLINSERT,'YYYYMM') = '202404'
--and kd_dist = '11'
and nousulan = 'POS5453020240419005'


select *
from POS5664020240418015


select *
from plngatepost.dpp
where (idpel,blth) in
(
    select idpel,blth
    from ophartde.VER_TEMP_DATA_LOCKING
    where to_char(TGLINSERT,'YYYYMM') = '202404'
--    and kd_dist = '56'
    and nousulan = 'POS5453020240419005'
)


select *
from olap.h2h
where (idpel,blth) in
(
    select idpel,blth
    from ophartde.VER_TEMP_DATA_LOCKING
    where to_char(TGLINSERT,'YYYYMM') = '202404'
--    and kd_dist = '56'
    and nousulan = 'POS5453020240419005'
)


select *
from OPHARTDE.VER_DATA_LOCKING_BANK
where nousulan = 'POS5453020240419005'


select * from olap.MASTER_DISTRIBUSI


select * from ophartde.VER_MASTER_BANK