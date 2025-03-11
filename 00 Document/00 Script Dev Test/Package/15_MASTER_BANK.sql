CREATE TABLE USERADISMONLAP.MASTER_BANK
(
  KODE_ERP    VARCHAR2(7 BYTE),
  SANDI       VARCHAR2(7 BYTE),
  KODE_BANK   VARCHAR2(3 BYTE),
  NAMA_BANK   VARCHAR2(30 BYTE),
  KANTOR      VARCHAR2(30 BYTE),
  ALAMAT      VARCHAR2(50 BYTE),
  KOTA        VARCHAR2(30 BYTE),
  STAT        VARCHAR2(4 BYTE),
  CLT         VARCHAR2(1 BYTE),
  SWITCHERID  VARCHAR2(7 BYTE),
  STATUS      VARCHAR2(1 BYTE),
  TELEPON     VARCHAR2(30 BYTE),
  FAX         VARCHAR2(30 BYTE),
  EMAIL       VARCHAR2(1000 BYTE),
  SUPPLEMENTAL LOG GROUP GGS_22029 (KODE_ERP) ALWAYS
);


CREATE INDEX USERADISMONLAP.IDX_MASTER_BANK_SND ON USERADISMONLAP.MASTER_BANK
(SANDI);

CREATE UNIQUE INDEX USERADISMONLAP.MASTER_BANK_PK ON USERADISMONLAP.MASTER_BANK
(KODE_ERP);

--insert data
SET DEFINE OFF;
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, KOTA, SWITCHERID, TELEPON, EMAIL)
 Values
   ('0020400', '0020400', '002', 'BANK RAKYAT INDONESIA', 'JAKARTA', 
    'Jl. JENDRAL SUDIRMAN', 'JAKARTA SELATAN', 'SYB53D3', '021-5752405', 'sto_rso@bri.co.id,sto_rso@corp.bri.co.id, maulana.muhammad@corp.bri.co.id,okky.syahputra@corp.bri.co.id,Seno_wijanarko@bri.co.id,evi.maizun@corp.bri.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, KOTA, STAT, CLT, TELEPON, 
    EMAIL)
 Values
   ('0090007', '0090092', '900', 'BANK BNI SYARIAH', 'JAKARTA - KOTA', 
    'JL. LADA 1', 'JAKARTA BARAT', 'GAB', '1', '021  ext : ', 
    'hpay.rekon3@bnisyariah.co.id,izul.saputra@bnisyariah.co.id,fajar.setiyawan@bnisyariah.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, KOTA, STAT, CLT, TELEPON, 
    EMAIL)
 Values
   ('0090010', '0090010', '009', 'BANK BNI', 'JAKARTA PUSAT', 
    'JL. JEND. SUDIRMAN KAV. 1', 'JAKARTA SELATAN', 'KC', '0', '021-500046 atau 68888', 
    'Zulkarnaen.Sofyan@bni.co.id,Panca.Budiono@bni.co.id,desy.kaswati24119@bni.co.id,Saras.Nurfitriana@bni.co.id,indriyanto@bni.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, KOTA, STAT, CLT, SWITCHERID, 
    TELEPON, EMAIL)
 Values
   ('0110000', '0110000', '011', 'BANK DANAMON INDONESIA', 'GABUNGAN', 
    'JL. KEBON SIRIH 15', 'JAKARTA PUSAT', 'GAB', '1', 'VI105V3', 
    '021-8064 5000  ext 6199', 'recon1.pln@danamon.co.id,sukedar.sukendar@danamon.co.id,group.cerr@danamon.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, SWITCHERID, 
    TELEPON)
 Values
   ('0110020', '0110020', '011', 'BANK DANAMON    ', 'SYB53D3', 
    '021-67777');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, KOTA, STAT, CLT, TELEPON, 
    EMAIL)
 Values
   ('0130006', '0130099', '013', 'BANK PERMATA', 'GABUNGAN', 
    'BANK BALI TOWER', ' JL. JEND SUDIRMAN KAV. 27', 'JAKA', 'G', '021 - 7455858 ext. 05951', 
    'channel_support@permatabank.co.id, swardani@permatabank.co.id, bujaya@permatabank.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, KOTA, STAT, CLT, TELEPON, 
    EMAIL)
 Values
   ('0140009', '0140012', '014', 'BANK CENTRAL ASIA', 'KANTOR PUSAT', 
    'JL. M.H. THAMRIN NO 1 JAKARTA', 'JAKARTA BARAT', 'GAB', '1', '021 23588000 Ext 18268', 
    'yudi_lesmana@bca.co.id,andre_parwinando@bca.co.id,hendri_taufik@bca.co.id,herry_darmanto@bca.co.id,bcasentrasetelmen@bca.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, KOTA, STAT, CLT, TELEPON, 
    EMAIL)
 Values
   ('0220482', '0220482', '022', 'BANK CIMB NIAGA', 'TANGERANG', 
    'JL.DAAN MOGOT NO.58 TANGERANG', 'JAKARTA BARAT', 'KC', '0', '021 29972400 ext. 80345', 
    'ecs117@cimbniaga.co.id,budi.oktopansyah@cimbniaga.co.id,astuti.nurhadiyati@cimbniaga.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, KOTA, STAT, CLT, TELEPON, 
    EMAIL)
 Values
   ('0230018', '0230018', '023', 'BANK UOB INDONESIA', 'JAKARTA', 
    'JLN.ASEMKA 34-35', 'JAKARTA BARAT', 'KP', '0', '021 2350 6000 ext 24079', 
    'atmops_all@UOB.CO.ID,Boyke.barmilda@uob.co.id,Shendy.batseba@uob.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, KOTA, STAT, CLT, TELEPON, 
    EMAIL)
 Values
   ('0160005', '0160000', '016', 'BANK MAYBANK INDONESIA', 'GABUNGAN', 
    'JLN.MH.THAMRIN NO.51', 'JAKARTAPUSAT', 'KC', '0', '21..', 
    'plnh2h@maybank.co.id,NTalantan@maybank.co.id,riphiyanti@maybank.co.id,Rebekka.Yessica@maybank.co.id,TD@maybank.co.id,THidayani@maybank.co.id,YEAndarukmi@maybank.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, ALAMAT, 
    KOTA, STAT, CLT, TELEPON)
 Values
   ('0410001', '0410302', '041', 'BANK HSBC    ', 'JL.HAYAM WURUK 8', 
    'JAKARTA PUSAT', 'GAB', '0', '021-52914722 / 0804-1-86-4722');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, KOTA, STAT, CLT, TELEPON, 
    EMAIL)
 Values
   ('0420305', '0420010', '042', 'BANK OF TOKYO MITSUBISHI UFJ', 'JAKARTA SUDIRMAN', 
    'JL.JEND.SUDIRMAN KAV.10-11 SUDIRMAN PLZ', 'JAKARTA PUSAT', 'KC', '0', '021-5706185', 
    'gcms_help@id.mufg.jp,suhendrayana_suhendrayana@id.mufg.jp,imam_susilo@id.mufg.jp');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, KOTA, STAT, CLT)
 Values
   ('0520302', '0520000', '052', 'BANK ABN AMRO ', 'JAKARTA JUANDA', 
    'JL.IR.H.JUANDA NO.23-24', 'JAKARTA PUSAT', 'KC', '0');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, KOTA, STAT, CLT, TELEPON, 
    EMAIL)
 Values
   ('0850001', '0370057', '085', 'BANK ARTHA GRAHA', 'GABUNGAN', 
    'BANK ARTHA GRAHA TOWER JL.JEND.SUDIRMAN', 'JAKARTA SELATAN', 'GAB', '0', '0-800-191-8880', 
    'eko_bachtiar@ag.co.id,koord_ppsuryo@ag.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, KOTA, STAT, CLT, TELEPON, 
    EMAIL)
 Values
   ('0280011', '0280011', '028', 'BANK OCBC NISP', 'KANTOR PUSAT', 
    'JLN.TAMAN CIBEUNYING SELATAN 31', 'BANDUNG', 'KP', '0', '021-', 
    'e-settlement@ocbcnisp.com,ade.rohmat@ocbcnisp.com,yusniana.friska@ocbcnisp.com,yusniana.friska@ocbc.id,esettlement@ocbc.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, KOTA, STAT, CLT, SWITCHERID, 
    TELEPON, EMAIL)
 Values
   ('0950011', '0950011', '095', 'BANK JTRUST INDONESIA', 'JAKARTA', 
    'Gdg Sentral Senayan II Lt. 22 Jl. Asia Afrika No.8', 'JAKARTA PUSAT', 'KP', '0', 'SYB53D3', 
    '021  ext :', 'atmcenter@jtrustbank.co.id, mhmantoko@jtrustbank.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, KOTA, STAT, CLT, TELEPON)
 Values
   ('1100019', '1100000', '110', 'BANK BJB', 'BANDUNG-NARIPAN', 
    'MENARA BANK JABAR', 'JL.NARIPAN NO.12-14', 'BAND', 'K', '14049');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, KOTA, STAT, CLT, TELEPON, 
    EMAIL)
 Values
   ('4410010', '4410133', '441', 'BANK BUKOPIN', 'JAKARTA', 
    'JL.MT.HARYONOKAV.50-51', 'JAKARTA BARAT', 'KP', '0', '14005', 
    'jasin@bukopin.co.id,iskandar@kbbukopin.com,seftian@kbbukopin.com,
bukopinet.helpdesk@kbbukopin.com,andi.adhanto@kbbukopin.com,muchlis.yazied@kbbukopin.com,indra.saputra@kbbukopin.com');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, KOTA, STAT, CLT, SWITCHERID, 
    EMAIL)
 Values
   ('1450015', '1450015', '145', 'BANK NUSANTARA PARAHYANGAN', 'BANDUNG-JUANDA', 
    'JL.IR.H.JUANDANO.95', 'BANDUNG', 'KP', '0', 'SYB53D3', 
    'jasa@bankbnp.com');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, KOTA, STAT, CLT, TELEPON)
 Values
   ('1460005', '1460005', '146', 'BANK OF INDIA INDONESIA', 'GABUNGAN', 
    'JL.H.SAMANHUDI NO.37', 'JAKARTA PUSAT', 'GAB', '0', '021-3500007');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, KOTA, STAT, CLT, TELEPON, 
    EMAIL)
 Values
   ('1470011', '1470011', '147', 'BANK MUAMALAT', 'JAKARTA', 
    'GD.ARTHALOKA', 'JL.JEND.SUDIRMAN NO.2', 'JAKA', 'K', '021 80666000 ext : 111237', 
    'agus.fitriyanto@bankmuamalat.co.id,recon_147@bankmuamalat.co.id,biller.operation@bankmuamalat.co.id,networkbiller.operation@bankmuamalat.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, KOTA, STAT, CLT, TELEPON, 
    EMAIL)
 Values
   ('1530016', '1530016', '153', 'BANK SINARMAS', 'JAKARTA', 
    'JL.KH.HASYIM ASHARI NO.38', 'JAKARTA PUSAT', 'KP', '0', '021  ext : ', 
    'pln.support@banksinarmas.com,evlyn.feraro@banksinarmas.com,pln.daily@banksinarmas.com,aulia.trianto@banksinarmas.com,amalia.n.istigfarin@banksinarmas.com,report.rekonsiliasi@banksinarmas.com,ahmad.koharudin@banksinarmas.com');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    KOTA, SWITCHERID, TELEPON, EMAIL)
 Values
   ('1570010', '1570010', '157', 'BANK MASPION', 'SURABAYA', 
    'SURABAYA', 'SYB53D3', '021  ext :', 'rekon_pln@bankmaspion.co.id, susiana@bankmaspion.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, KOTA, STAT, CLT, SWITCHERID, 
    TELEPON, EMAIL)
 Values
   ('1610017', '1610017', '161', 'BANK GANESHA', 'KANTOR PUSAT', 
    'JL.HAYAM WURUK NO.28', 'JAKARTA', 'KP', '0', 'SYB53D3', 
    '021 3855 345', 'gsh-plnrekon@bankganesha.co.id,burhani@bankganesha.co.id,yonatan@bankganesha.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, KOTA, SWITCHERID, TELEPON, EMAIL)
 Values
   ('2000001', '2000001', '200', 'BANK TABUNGAN NEGARA', 'JAKARTA', 
    'JL. GAJAH MADA 1 HARMONI', 'JAKARTA PUSAT', 'SYB53D3', '021-500286', 'obsd.recon@btn.co.id,richi.ilham@btn.co.id,giyono@btn.co.id,deni.irfansyah@btn.co.id,rekonsiliasi@magnakarsa.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, KOTA, STAT, CLT, TELEPON, 
    EMAIL)
 Values
   ('5010011', '5010011', '501', 'BANK BCA DIGITAL', 'JAKARTA', 
    'JL. M.H. THAMRIN NO.81 MENTENG RT.1/RW.6', 'JAKARTA PUSAT', 'KP', '0', '021  ext :', 
    'partnership@bcadigital.co.id,lisa.wijaya@bcadigital.co.id,ratna.basuki@bcadigital.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, KOTA, STAT, CLT, TELEPON, 
    EMAIL)
 Values
   ('5060003', '5060000', '506', 'BANK MEGA SYARIAH', 'GABUNGAN', 
    'JL.HR RASUNA SAID KAV.C-7', 'JAKARTA SELATAN', 'GAB', '0', '021-29852222', 
    'rekonpln@megasyariah.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, KOTA, STAT, CLT, SWITCHERID, 
    TELEPON, EMAIL)
 Values
   ('5130014', '5130014', '513', 'BANK INA PERDANA', 'JAKARTA', 
    'JL.ABDUL MUIS NO.40', 'JAKARTA PUSAT', 'KP', '0', 'SYB53D3', 
    '021  ext :', 'operation.central@bankina.co.id, imamwardani@bankina.co.id, imam@bankina.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, KOTA, STAT, CLT, TELEPON, 
    EMAIL)
 Values
   ('5210031', '5210031', '521', 'BANK SYARIAH BUKOPIN', 'KANTOR PUSAT', 
    'JL.SALEMBA RAYA NO.55', 'JAKARTA', 'KP', '0', '021-2300912', 
    'rekon_pln@syariahbukopin.co.id,daniali@syariahbukopin.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, KOTA, STAT, CLT, TELEPON, 
    EMAIL)
 Values
   ('0610000', '0610000', '061', 'BANK ANZ INDONESIA', 'JAKARTA', 
    'ANZ Tower Lt 11 Jl Jend Sudirman Kav 33A', 'JAKARTA', 'KP', '0', '021-500269', 
    'Mira.Mawarti@anz.com,Catharina.Indriani@anz.com,ID-ANZCardOps@anz.com');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    KOTA, TELEPON)
 Values
   ('1200000', '1200000', '120', 'BANK SUMSELBABEL', 'SUMSEL BABEL', 
    'PALEMBANG', '0711-5228080');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KOTA, 
    TELEPON, EMAIL)
 Values
   ('1300000', '1300000', '130', 'BPD NTT', 'KUPANG', 
    '021  ext :', 'rekonpln@bpdntt.co.id, anton.s@bpdntt.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    KOTA, TELEPON, EMAIL)
 Values
   ('4250000', '4250000', '425', 'BANK JABAR BANTEN SYARIAH', 'BANDUNG', 
    'BANDUNG', '022-72272727', 'rini.astuti@bjbs.co.id,pradithia.manggala.yuda@bjbs.co.id,rekonsiliasi.pln@bjbs.co.id,sonni.sofian@bjbs.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, TELEPON, 
    EMAIL)
 Values
   ('1140000', '1140000', '114', 'BPD JATIM', '021  ext :', 
    'cardcenter@bankjatim.co.id, aan.faizal@bankjatim.co.id,bangun.sasongko@bankjatim.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KOTA, 
    TELEPON, EMAIL)
 Values
   ('1280000', '1280000', '128', 'BPD NTB', 'MATARAM', 
    '0370-648765 , 636331', 'rekonpln@bankntb.co.id,wulan.tyas@bankntb.co.id,made.rakendra@bankntb.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, CLT, 
    TELEPON, EMAIL)
 Values
   ('1190000', '1190000', '119', 'BPD RIAU KEPRI', '0', 
    '0... ext : ....', 'keuangan@bankriaukepri.co.id,tuah.adhitama@bankriaukepri.co.id,sulastri@bankriaukepri.co.id,echannelbrk@bankriaukepri.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, CLT, 
    TELEPON, EMAIL)
 Values
   ('1220000', '1220000', '122', 'BPD KALSEL', '0', 
    '021  ext :', 'cardcenter@bankkalsel.co.id, hadi@bankkalsel.co.id, amira@bankkalsel.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, TELEPON, 
    EMAIL)
 Values
   ('1210000', '1210000', '121', 'BPD LAMPUNG', '021  ext :', 
    'rekonpln@banklampung.co.id, radit@banklampung.co.id, hendrik@banklampung.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, TELEPON, EMAIL)
 Values
   ('1260000', '1260000', '126', 'BANK SULSELBAR', 'KANTOR PUSAT', 
    'JL. DR. Ratulangi No. 16 Makassar', '081355023117', 'rekon.bssb@banksulselbar.co.id,umar.syam@banksulselbar.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, KOTA, STAT, CLT, TELEPON, 
    EMAIL)
 Values
   ('1170010', '1170010', '117', 'BANK SUMUT', 'KANTOR PUSAT', 
    'JL.IMAM BONJOL NO.18', 'MEDAN', 'KP', '0', '061-4155100 ext 1307', 
    'rekonsiliasi.atm@banksumut.com,rekonsiliasi.atm@banksumut.co.id,muhammadridhaturani@banksumut.co.id,abadiputra@banksumut.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, KOTA, SWITCHERID)
 Values
   ('0000001', '0000001', '001', 'PST', 'JAKARTA', 
    'Jl. JENDRAL SUDIRMAN', 'JAKARTA SELATAN', 'PLN53P3');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    SWITCHERID, TELEPON, EMAIL)
 Values
   ('5530000', '5530000', '553', 'BANK MAYORA', 'JAKARTA', 
    'SYB53D3', '021 5655288 EXT 1428', 'tumpal.manurung@bankmayora.co.id, debi.fuyanto@bankmayora.co.id, pln.bankmayora@bankmayora.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, EMAIL)
 Values
   ('5360000', '5360000', '536', 'BANK CENTRAL ASIA SYARIAH', 'dina_aryati@bcasyariah.co.id,rekon@bcasyariah.co.id,Andru_Santoso@bcasyariah.co.id,maurus_damian@bcasyariah.co.id,
agus_tavip@bcasyariah.co.id,anton_wibowo@bcasyariah.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, TELEPON, EMAIL)
 Values
   ('2130000', '2130000', '213', 'BANK BTPN', 'JAKARTA', 
    'JL. DR. IDE ANAK AGUNG GDE AGUNG BLOK 6.2 JAKSEL', '021-2567000', 'mohamad.riduan@btpn.com,dwirachmi.cheryyanti@btpn.com,bainul.irfan@btpn.com');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, TELEPON, EMAIL)
 Values
   ('1130015', '1130015', '113', 'BPD JATENG', 'KANTOR PUSAT', 
    'JL. PEMUDA NO. 142', '024-3547541', 'machjudin@bankjateng.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, TELEPON, EMAIL)
 Values
   ('1320000', '1320000', '132', 'BPD PAPUA', 'KANTOR PUSAT', 
    'JL. AHMAD YANI NO 5-7', '0967-532011', 'sukri.gazali@bankpapua.co.id,settlement@bankpapua.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, TELEPON, EMAIL)
 Values
   ('0022295', '0022295', '422', 'BANK BRI SYARIAH', 'KANTOR PUSAT', 
    'MENARA JAMSOSTEK JL. GATOT SUBROTO NO 38', '085715335370', 'rekonpln@brisyariah.co.id,afiyah@brisyariah.co.id,medina.corlianty@brisyariah.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, TELEPON, EMAIL)
 Values
   ('0310004', '0310004', '031', 'CITIBANK', 'KANTOR PUSAT', 
    'JL. JENDRAL SUDIRMAN KAV 54-55 JAKPUS', '021-2529683, 52908725', 'Taxidbilling.service@citi.com,ahmad.ridho@citi.com,dede.darmawan@citi.com,citibank.1billops@citi.com');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, KOTA, STAT, CLT, TELEPON, 
    EMAIL)
 Values
   ('0080017', '0080061', '008', 'BANK MANDIRI', 'KANTOR PUSAT OPS.', 
    'PLAZA EXIM', ' JL. GATOT SUBROTO KAV 3', 'JAKA', 'K', '021  ext :', 
    'rekonsiliasi@bankmandiri.co.id, rekonsiliasiPLN@bankmandiri.co.id, gunawan.muhamad@bankmandiri.co.id, farhan.pratama@bankmandiri.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, KOTA, STAT, CLT, TELEPON, 
    EMAIL)
 Values
   ('0190004', '0190017', '019', 'BANK PANIN    ', 'GABUNGAN', 
    'JLN.JEND.SUDIRMAN', ' PANIN BANK CENTRE', 'JAKA', 'G', '021  ext :', 
    'payment.settlement@panin.co.id, yosep.hin@panin.co.id, sumiyati@panin.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, TELEPON, EMAIL)
 Values
   ('7000001', '7000001', '700', 'PT POS INDONESIA', 'KANTOR PUSAT', 
    'GD POS IBUKOTA JL. GEDUNG KESENIAN NO. 2 JAKPUS', '021 3522691 ext', 'fadjri.ardiansah@posindonesia.co.id, ugil.latwidjiadi@posindonesia.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, KOTA, STAT, CLT, TELEPON, 
    EMAIL)
 Values
   ('9999999', '9999999', '999', 'ICON PLP MDR', 'JAKARTA PUSAT', 
    'Gedung Trapesium Lt 1 & 4, Kawasan PLN Pusat Jl tr', 'JAKARTA SELATAN', 'KC', '0', '021-5253019', 
    'rekonmerchant.iconpay@iconpln.co.id,riezky.noor@iconpln.co.id,haidar.ahmad@iconpln.co.id,ritel.treasury@iconpln.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, KOTA, STAT, CLT, SWITCHERID, 
    TELEPON, EMAIL)
 Values
   ('0890016', '0890016', '089', 'BANK RABO', 'JAKARTA', 
    'JLABDUL MUIS NO.28', 'JAKARTA PUSAT', 'KP', '0', 'SYB53D3', 
    '021-500080', 'Anak.Negara@rabobank.com,lisa.karis@rabobank.com,lisa.karis@rabobank.com,Zakaria.Nasution@rabobank.com,Sandi.Kusumadita@rabobank.com,
Agung.Septyanto@rabobank.com,Abhimata.Andridina@rabobank.com,fm.id.RII.billpayment@rabobank.com');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, TELEPON, EMAIL)
 Values
   ('1230000', '1230000', '123', 'BPD KALBAR', 'KANTOR PUSAT POS.', 
    'JL. RAHADI OSMAN NO. 10 PONTIANAK', '0561 732148 ext 317', 'risna.hasrilianti@bpdkalbar.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, TELEPON, EMAIL)
 Values
   ('4260008', '4260008', '426', 'BANK MEGA', 'JAKARTA PUSAT', 
    'JL.KAPTEN P. TENDEAN NO 12', '021.....', 'fakhrezza@bankmega.com,reconcile.ctop@bankmega.com,rekonpln.ctop@bankmega.com,anwar.hermawan@bankmega.com,panji.permana@bankmega.com');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, TELEPON, EMAIL)
 Values
   ('1120011', '1120015', '112', 'BPD DIY', 'KANTOR PUSAT', 
    'JL.TENTARA PELAJAR 7', '0274-561614', 'fadhlillah.maulana@bpddiy.co.id, riski.arianto@bpddiy.co.id, berdidrata@bpddiy.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, KOTA, STAT, CLT, TELEPON, 
    EMAIL)
 Values
   ('1110013', '1110013', '111', 'BANK DKI', 'JAKARTA KTR.PUSAT', 
    'JL.IR.H.JUANDA III/7-9', 'JAKARTA PUSAT', 'KP', '0', '021  ext :', 
    'bo.central@bankdki.co.id, retno.septiawati@bankdki.co.id, thomy.kurniawan@bankdki.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, TELEPON, 
    EMAIL)
 Values
   ('6003110', '6000001', '600', 'BPRKS', '021  ext :', 
    'rekonpln@bprks.co.id, raymon.sidabutar@bprks.co.id, kurniawan.urip@bprks.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, KOTA, STAT, CLT, SWITCHERID, 
    TELEPON, FAX, EMAIL)
 Values
   ('0870010', '0870010', '087', 'BANK HSBC INDONESIA', 'KANTOR PUSAT KUNING', 
    'Jl Setiabudi Selatan kav 7-8 Jakarta Selatan', 'JAKARTA', 'KP', '0', 'SYB53D3', 
    '0215246864', '021-57904461', 'data.centre.operations.hbid@hsbc.co.id, rinaldijpamuntjak@hsbc.co.id, syafrilbachtiar@hsbc.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, KOTA, STAT, CLT, SWITCHERID, 
    TELEPON, EMAIL)
 Values
   ('5660018', '5660018', '566', 'BANK VICTORIA INTERNATIONAL', 'JAKARTA', 
    'JL.JEND.SUDIRMAN NO.1 PANIN BUILDING CT', 'JAKARTA SELATAN', 'KP', '0', 'SYB53D3', 
    '021-2700180', 'andre@victoriabank.co.id,pln@victoriabank.co.id,saptarini@victoriabank.co.id,ruri@victoriabank.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, KOTA, SWITCHERID, TELEPON, EMAIL)
 Values
   ('4850010', '4850010', '485', 'BANK MNC INTERNASIONAL', 'JAKARTA', 
    'Menara ICB Bumiputera lt. 2 Jl. Probolinggo No. 18', 'JAKARTA', 'SYB53D3', '021 29805555 EXT 59828-30', 'adam.zulpikar@mncbank.co.id,payment@mncbank.co.id,kliringjkt@mncbank.co.id,swasono@mncbank.co.id,kliring@mncbank.co.id,nita.srirahayu@mncbank.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, KOTA, STAT, CLT, TELEPON, 
    EMAIL)
 Values
   ('1290013', '1290013', '129', 'BPD BALI', 'KANTOR PUSAT', 
    'JL.RAYA PUPUTAN NITIMANDALA', 'DENPASAR', 'DENP', 'K', '0361-223301', 
    'dewi.andayani@bpdbali.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KOTA, 
    TELEPON, EMAIL)
 Values
   ('0500000', '0500000', '050', 'BANK STANDARD CHARTERED', 'JAKARTA', 
    '021  ext :', 'CB-Ops.settlement@sc.com, forestriena-A.Budiningrum@sc.com, yulia.puspitasari@sc.com');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, TELEPON, EMAIL)
 Values
   ('0970000', '0970000', '097', 'MAYAPADA', 'KANTOR PUSAT', 
    'jl. Jend Sudirman Kav 27 JAKARTA SELATAN', '021-2500570 ext 1704', 'bram.markus@bankmayapada.com,atm.operation@bankmayapada.com,ATM.Operation@bankmayapada.com,atm.settlement@bankmayapada.com');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, KOTA, STAT, CLT, SWITCHERID, 
    TELEPON, EMAIL)
 Values
   ('4510017', '4510017', '451', 'BANK SYARIAH INDONESIA', 'JAKARTA', 
    'JL.MH.THAMRIN NO.5', 'JAKARTA PUSAT', 'KP', '0', '451CA01', 
    '021 - 2300509', 'dbo-reconciliation@bankbsi.co.id,mely.rosmelati0275@bankbsi.co.id,asiswantoro@bankbsi.co.id,ridwan.taruna@bankbsi.co.id,iwan.muhamad@bankbsi.co.id,
ebp@bankbsi.co.id,reconciliation@bankbsi.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, KOTA, STAT, CLT, TELEPON, 
    EMAIL)
 Values
   ('9990014', '9990014', '014', 'ICON PLP BCA', 'JAKARTA PUSAT', 
    'Gedung Trapesium Lt 1 & 4, Kawasan PLN Pusat Jl tr', 'JAKARTA SELATAN', 'KC', '0', '021-5253019', 
    'rekonmerchant.iconpay@iconpln.co.id,riezky.noor@iconpln.co.id,dhamar.sumarwan@iconpln.co.id,ritel.treasury@iconpln.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, KOTA, STAT, CLT, TELEPON, 
    EMAIL)
 Values
   ('9990009', '9990009', '009', 'ICON PLP BNI', 'JAKARTA PUSAT', 
    'Gedung Trapesium Lt 1 & 4, Kawasan PLN Pusat Jl tr', 'JAKARTA SELATAN', 'KC', '0', '021-5253019', 
    'rekonmerchant.iconpay@iconpln.co.id,riezky.noor@iconpln.co.id,dhamar.sumarwan@iconpln.co.id,ritel.treasury@iconpln.co.id');
Insert into USERADISMONLAP.MASTER_BANK
   (KODE_ERP, SANDI, KODE_BANK, NAMA_BANK, KANTOR, 
    ALAMAT, KOTA, STAT, CLT, TELEPON, 
    EMAIL)
 Values
   ('9990002', '9990002', '002', 'ICON PLP BRI', 'JAKARTA PUSAT', 
    'Gedung Trapesium Lt 1 & 4, Kawasan PLN Pusat Jl tr', 'JAKARTA SELATAN', 'KC', '0', '021-5253019', 
    'rekonmerchant.iconpay@iconpln.co.id,riezky.noor@iconpln.co.id,dhamar.sumarwan@iconpln.co.id,ritel.treasury@iconpln.co.id');
COMMIT;

