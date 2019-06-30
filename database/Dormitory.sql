CREATE TABLE phong (
	sncur int not null,
	snmax int not null,
	sophong int not null,
	gioitinh varchar(5) not null,
	msphong int not null,
	mskhu int not null
);
    
create table khuktx (
	mskhu int not null,
	tenkhu varchar(5) not null,
	giaphong int not null
    );
    
create table canboquanly (
	mscb int not null,
	nscb date,
	gtcb varchar(5) not null,
	qqcb varchar(20) not null,
	sdt varchar(11) not null,
	email varchar(50) not null,
	mskhu int not null
    );
    
create table phieudangky(
	msphong int not null,
	mssv int not null,
	kyo int not null,
	trangthaidk varchar(20) not null,
	ngaydk date,
	ngayduyet date,
	lephi int not null,
	mscb int
    );

create table sinhvien (
	mssv int not null,
    nssv date,
	gtsv varchar(5) not null,
	lop varchar(10) not null,
	qqsv varchar(20) not null,
	email varchar(50) not null,
	sdt varchar(11) not null
    );
    
alter table phong add constraint pkey_ttp primary key (msphong);
alter table khuktx add constraint pkey_kkt primary key (mskhu);
alter table canboquanly add constraint pkey_cbql primary key (mscb);
alter table sinhvien add constraint pkey_sv primary key (mssv);
alter table users add constraint pkey_tk primary key (email);
alter table phieudangky add constraint pkey_id primary key (msphong,mssv,kyo);

alter table phong add constraint fk_p_k foreign key (mskhu) references khuktx(mskhu);
alter table canboquanly add constraint fk_c_k foreign key (mskhu) references khuktx(mskhu);
alter table phieudangky add constraint fk_pdk_p foreign key (msphong) references phong(msphong);
alter table phieudangky add constraint fk_pdk_s foreign key (mssv) references sinhvien(mssv);
alter table sinhvien add constraint fk_s_a foreign key (ussv) references accounts(taikhoan);
alter table canboquanly add constraint fk_c_a foreign key (uscb) references accounts(taikhoan);
