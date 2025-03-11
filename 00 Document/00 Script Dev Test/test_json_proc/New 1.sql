select *
from ETMP.REKAP_PENETAPAN_TMP
where thbl = '202405'
and unitupi = '32'
and idurut in ('10510', '10610')
and unitup = '32111'

select *
from ETMP.TRANS_VERIF_GANGGUAN_ETMP
where THBLLAP = '202405'
and unitupi = '32'
and idurut in ('10510', '10610')
and unitup = '32111'
order by THBLLAP, unitupi, UNITUP, IDURUT, KODE_INDIKATOR