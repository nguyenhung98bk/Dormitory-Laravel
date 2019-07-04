CREATE TABLE phong (
	id int not null,
	sophong int not null,
	id_khu int not null,
	sncur int not null,
	snmax int not null,
	gioitinh varchar(5) not null,
	updated_at date
);
    
create table khuktx (
	id int not null,
	tenkhu varchar(5) not null,
	giaphong int not null
    );
    
create table canboquanly (
	mscb int not null,
	nscb date not null,
	gtcb varchar(5) not null,
	qqcb varchar(20) not null,
	sdt varchar(11) not null,
	email varchar(50) not null,
	id_khu int not null
    );
    
create table phieudangky(
	id_phong int not null,
	mssv int not null,
	name varchar(30) not null,
	nam int not null,
	trangthaidk varchar(20) not null,
	ngaydk date not null,
	updated_at date,
	lephi int not null,
	mscb int
    );

create table sinhvien (
	mssv int not null,
    nssv date not null,
	gtsv varchar(5) not null,
	lop varchar(10) not null,
	qqsv varchar(20) not null,
	email varchar(50) not null,
	sdt varchar(11) not null
    );
    
alter table phong add constraint pkey_ttp primary key (id);
alter table khuktx add constraint pkey_kkt primary key (id);
alter table canboquanly add constraint pkey_cbql primary key (mscb);
alter table sinhvien add constraint pkey_sv primary key (mssv);
alter table phieudangky add constraint pkey_id primary key (id_phong,mssv,nam);

alter table phong add constraint fk_p_k foreign key (id_khu) references khuktx(id);
alter table canboquanly add constraint fk_c_k foreign key (id_khu) references khuktx(id);
alter table phieudangky add constraint fk_pdk_p foreign key (id_phong) references phong(id);
alter table phieudangky add constraint fk_pdk_s foreign key (mssv) references sinhvien(mssv);
alter table sinhvien add constraint fk_s_a foreign key (email) references users(email);
alter table canboquanly add constraint fk_c_a foreign key (email) references users(email);
