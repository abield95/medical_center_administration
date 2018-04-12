create table patients(id_bin binary(16), name varchar(200));

alter table patients add
	id_text varchar(36) generated always as
	(
		insert(
			insert(
				insert(
					insert(
						hex(
							concat(substr(id_bin,5,4), substr(id_bin,3,2),
									substr(id_bin,1,2), substr(id_bin,9,8))
						),
					9,0,'-'),
				14,0,'-'),
			19,0,'-'),
		24,0,'-')
	)virtual;

	#inserting new user
	set @u = unhex(replace(uuid(),'-',''));
	insert into patients(id_bin, name)
	values
	(
		concat(substr(@u, 7, 2), substr(@u, 5, 2),
				substr(@u, 1, 4), substr(@u, 9, 8)),
			"other values"
	);

	#delete or update
	#set @u = unhex(replace('94BCB97F-3C15-11E8-8BFC-54AB3AD3C46F','-',''));
#set @delete = concat(substr(@u, 7, 2), substr(@u, 5, 2),
#				substr(@u, 1, 4), substr(@u, 9, 8));
#delete FROM medical_center.mainrecords where id_bin_record=@delete;

insert(insert(insert(insert(hex(concat(substr(`id_bin_patient`,5,4),substr(`id_bin_patient`,3,2),substr(`id_bin_patient`,1,2),substr(`id_bin_patient`,9,8))),9,0,'-'),14,0,'-'),19,0,'-'),24,0,'-')