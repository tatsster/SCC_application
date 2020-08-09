--
-- PostgreSQL database dump
--

-- Dumped from database version 12.3
-- Dumped by pg_dump version 12.0

-- Started on 2020-06-19 16:38:26 +07

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 3321 (class 0 OID 26392)
-- Dependencies: 221
-- Data for Name: building; Type: TABLE DATA; Schema: public; Owner: user_scc
--

COPY public.building (building_order, building_name) FROM stdin;
14	A4
15	B4
\.


--
-- TOC entry 3312 (class 0 OID 26320)
-- Dependencies: 212
-- Data for Name: constant; Type: TABLE DATA; Schema: public; Owner: user_scc
--

COPY public.constant (constant_id, constant_name, constant_value) FROM stdin;
1	step_change_value	-3
\.


--
-- TOC entry 3309 (class 0 OID 26302)
-- Dependencies: 209
-- Data for Name: device; Type: TABLE DATA; Schema: public; Owner: user_scc
--

COPY public.device (device_floor_name, device_room_name, device_id, device_name, device_status, device_automation, device_additional, device_updated_by, device_building_name, device_ip, device_port, device_topic, device_username, device_password, device_pid) FROM stdin;
5	500	AIRC300	Air Conditioner	f	f	[30.0,30.0,20.0,20.0,3.75]	\N	B4	52.187.125.59	1883	Topic/LightD	BKvm	Hcmut_CSE_2020	\N
\.


--
-- TOC entry 3306 (class 0 OID 26192)
-- Dependencies: 206
-- Data for Name: device_log; Type: TABLE DATA; Schema: public; Owner: user_scc
--

COPY public.device_log (device_order, device_id, device_status, device_timestamp, device_updated_by) FROM stdin;
25	AIRC300	t	1591440812	\N
26	AIRC300	f	1591441175	\N
33	AIRC300	t	1591609314	Automation_Automation_Automation_test
34	AIRC300	f	1591609347	Automation_Automation_Automation_Automation_test
35	AIRC300	t	1591609688	Automation_Automation_Automation_Automation_Automation_test
36	AIRC300	f	1591610358	Automation_Automation_Automation_Automation_Automation_Automation_test
37	AIRC300	t	1591610418	Automation_Automation_Automation_Automation_Automation_Automation_Automation_test
38	AIRC300	f	1591610552	Automation_Automation_Automation_Automation_Automation_Automation_Automation_Automation_test
41	AIRC300	t	1591636703	Automation_test
42	AIRC300	f	1591636745	Automation_test
43	AIRC300	t	1591636790	Automation_test
44	AIRC300	f	1591636892	Automation_test
45	AIRC300	t	1591708699	Automation_test
46	AIRC300	f	1591709611	Automation_test
47	AIRC300	t	1591709650	Automation_test
\.


--
-- TOC entry 3323 (class 0 OID 26403)
-- Dependencies: 223
-- Data for Name: floor; Type: TABLE DATA; Schema: public; Owner: user_scc
--

COPY public.floor (floor_order, floor_building, floor_name) FROM stdin;
4	A4	5
5	B4	5
\.


--
-- TOC entry 3314 (class 0 OID 26349)
-- Dependencies: 214
-- Data for Name: language; Type: TABLE DATA; Schema: public; Owner: user_scc
--

COPY public.language (language_id, language_name, language_code) FROM stdin;
2	Vietnamese	vn
1	English	us
\.


--
-- TOC entry 3319 (class 0 OID 26373)
-- Dependencies: 219
-- Data for Name: permission; Type: TABLE DATA; Schema: public; Owner: user_scc
--

COPY public.permission (permission_id, permission_role, permission_report, permission_profile, permission_user_list, permission_create_user, permission_edit_user, permission_system_settings, permission_dashboard_settings, permission_create_role, permission_edit_role, permission_dashboard, permission_settings, permission_tab_permission, permission_create_building_floor_room, permission_edit_building_floor_room, permission_create_device_sensor, permission_edit_device_sensor) FROM stdin;
1	Super Admin	t	t	t	t	t	t	t	t	t	t	t	t	t	t	t	t
2	Teacher	t	t	t	f	f	f	f	f	f	t	f	f	f	f	f	f
3	School Manager	t	t	t	f	f	t	t	f	f	t	t	f	f	f	f	f
\.


--
-- TOC entry 3325 (class 0 OID 26443)
-- Dependencies: 225
-- Data for Name: room; Type: TABLE DATA; Schema: public; Owner: user_scc
--

COPY public.room (room_order, room_building, room_floor, room_name) FROM stdin;
1	A4	5	500
2	B4	5	500
\.


--
-- TOC entry 3310 (class 0 OID 26310)
-- Dependencies: 210
-- Data for Name: sensor; Type: TABLE DATA; Schema: public; Owner: user_scc
--

COPY public.sensor (sensor_floor_name, sensor_room_name, sensor_id, sensor_name, sensor_building_name, sensor_value, sensor_ip, sensor_port, sensor_topic, sensor_username, sensor_password, sensor_pid) FROM stdin;
5	500	TempHumi	Temperature And Humidity Sensor	B4	[26 , 49]	52.187.125.59	1883	Topic/TempHumi	BKvm	Hcmut_CSE_2020	\N
5	500	id0	Real temperature and humidity sensor	A4	[26 , 49]	13.76.250.158	1883	Topic/TempHumi	BKvm2	Hcmut_CSE_2020	\N
\.


--
-- TOC entry 3308 (class 0 OID 26269)
-- Dependencies: 208
-- Data for Name: sensor_log; Type: TABLE DATA; Schema: public; Owner: user_scc
--

COPY public.sensor_log (sensor_order, sensor_id, sensor_temp, sensor_humid, sensor_heat_index, sensor_timestamp) FROM stdin;
4601	TempHumi 	26.0	61.0	21.2	1592533734
4602	TempHumi 	26.0	61.0	21.2	1592533836
4603	TempHumi 	26.0	62.0	21.2	1592533836
4604	TempHumi 	26.0	62.0	21.2	1592533845
4605	TempHumi 	26.0	59.0	21.1	1592534184
4606	TempHumi 	26.0	57.0	21.0	1592534327
4607	TempHumi 	26.0	57.0	21.0	1592534337
4608	TempHumi 	26.0	61.0	21.2	1592534384
4609	TempHumi 	26.0	62.0	21.2	1592534384
4610	TempHumi 	26.0	63.0	21.3	1592534387
4611	TempHumi 	26.0	62.0	21.2	1592534397
4612	TempHumi 	26.0	60.0	21.1	1592534468
4613	TempHumi 	26.0	60.0	21.1	1592534479
4614	TempHumi 	26.0	60.0	21.1	1592534487
4615	TempHumi 	26.0	59.0	21.1	1592534498
4616	TempHumi 	26.0	59.0	21.1	1592534508
4617	TempHumi 	26.0	59.0	21.1	1592534518
4618	TempHumi 	26.0	59.0	21.1	1592534529
4619	TempHumi 	26.0	58.0	21.0	1592534547
4620	TempHumi 	26.0	58.0	21.0	1592534558
4621	TempHumi 	-999.0	-999.0	-1156.2	1592534568
4622	TempHumi 	26.0	57.0	21.0	1592534579
4623	TempHumi 	26.0	57.0	21.0	1592534589
4624	TempHumi 	26.0	60.0	21.1	1592534627
4625	TempHumi 	26.0	58.0	21.0	1592534637
4626	TempHumi 	26.0	58.0	21.0	1592534647
4627	TempHumi 	26.0	57.0	21.0	1592534658
4628	TempHumi 	26.0	57.0	21.0	1592534676
4629	TempHumi 	26.0	57.0	21.0	1592534687
4630	TempHumi 	26.0	57.0	21.0	1592534697
4631	TempHumi 	26.0	56.0	20.9	1592534718
4632	TempHumi 	26.0	56.0	20.9	1592534726
4633	TempHumi 	26.0	56.0	20.9	1592534737
4634	TempHumi 	26.0	56.0	20.9	1592534747
4635	TempHumi 	26.0	56.0	20.9	1592534758
4636	TempHumi 	26.0	56.0	20.9	1592534768
4637	TempHumi 	26.0	56.0	20.9	1592534776
4638	TempHumi 	26.0	56.0	20.9	1592534787
4639	TempHumi 	26.0	56.0	20.9	1592534797
4640	TempHumi 	26.0	63.0	21.3	1592534808
4641	TempHumi 	26.0	63.0	21.3	1592534818
4642	TempHumi 	26.0	60.0	21.1	1592534837
4643	TempHumi 	26.0	59.0	21.1	1592534847
4644	TempHumi 	26.0	58.0	21.0	1592534858
4645	TempHumi 	26.0	57.0	21.0	1592534868
4646	TempHumi 	26.0	58.0	21.0	1592534878
4647	TempHumi 	26.0	57.0	21.0	1592534887
4648	TempHumi 	26.0	57.0	21.0	1592534897
4649	TempHumi 	26.0	57.0	21.0	1592534908
4650	TempHumi 	26.0	59.0	21.1	1592534918
4651	TempHumi 	26.0	58.0	21.0	1592534928
4652	TempHumi 	26.0	57.0	21.0	1592534937
4653	TempHumi 	26.0	58.0	21.0	1592534947
4654	TempHumi 	26.0	58.0	21.0	1592534958
4655	TempHumi 	26.0	57.0	21.0	1592534968
4656	TempHumi 	26.0	57.0	21.0	1592534978
4657	TempHumi 	26.0	57.0	21.0	1592534997
4658	TempHumi 	26.0	56.0	20.9	1592535008
4659	TempHumi 	26.0	56.0	20.9	1592535018
4660	TempHumi 	26.0	56.0	20.9	1592535028
4661	TempHumi 	26.0	56.0	20.9	1592535039
4662	TempHumi 	-999.0	-999.0	-1156.2	1592535058
4663	TempHumi 	26.0	55.0	20.9	1592535068
4664	TempHumi 	26.0	55.0	20.9	1592535079
4665	TempHumi 	26.0	55.0	20.9	1592535089
4666	TempHumi 	26.0	55.0	20.9	1592535097
4667	TempHumi 	26.0	54.0	20.8	1592535108
4668	TempHumi 	26.0	54.0	20.8	1592535119
4669	TempHumi 	26.0	54.0	20.8	1592535129
4670	TempHumi 	26.0	54.0	20.8	1592535139
4671	TempHumi 	26.0	54.0	20.8	1592535162
4672	TempHumi 	26.0	54.0	20.8	1592535168
4673	TempHumi 	26.0	54.0	20.8	1592535179
4674	TempHumi 	26.0	54.0	20.8	1592535189
4675	TempHumi 	26.0	54.0	20.8	1592535199
4676	TempHumi 	26.0	54.0	20.8	1592535208
4677	TempHumi 	26.0	54.0	20.8	1592535219
4678	TempHumi 	26.0	54.0	20.8	1592535229
4679	TempHumi 	26.0	54.0	20.8	1592535239
4680	TempHumi 	26.0	54.0	20.8	1592535249
4681	TempHumi 	26.0	54.0	20.8	1592535258
4682	TempHumi 	26.0	54.0	20.8	1592535268
4683	TempHumi 	26.0	54.0	20.8	1592535279
4684	TempHumi 	26.0	54.0	20.8	1592535289
4685	TempHumi 	26.0	53.0	20.8	1592535299
4686	TempHumi 	26.0	53.0	20.8	1592535308
4687	TempHumi 	26.0	53.0	20.8	1592535318
4688	TempHumi 	26.0	53.0	20.8	1592535329
4689	TempHumi 	26.0	52.0	20.7	1592535339
4690	TempHumi 	26.0	52.0	20.7	1592535350
4691	TempHumi 	26.0	52.0	20.7	1592535360
4692	TempHumi 	26.0	52.0	20.7	1592535368
4693	TempHumi 	26.0	52.0	20.7	1592535379
4694	TempHumi 	26.0	52.0	20.7	1592535389
4695	TempHumi 	26.0	52.0	20.7	1592535400
4696	TempHumi 	26.0	53.0	20.8	1592535410
4697	TempHumi 	26.0	53.0	20.8	1592535418
4698	TempHumi 	26.0	53.0	20.8	1592535429
4699	TempHumi 	26.0	53.0	20.8	1592535439
4700	TempHumi 	26.0	53.0	20.8	1592535450
4701	TempHumi 	26.0	53.0	20.8	1592535460
4702	TempHumi 	26.0	53.0	20.8	1592535469
4703	TempHumi 	26.0	53.0	20.8	1592535479
4704	TempHumi 	26.0	53.0	20.8	1592535489
4705	TempHumi 	26.0	52.0	20.7	1592535500
4706	TempHumi 	26.0	53.0	20.8	1592535510
4707	TempHumi 	26.0	53.0	20.8	1592535518
4708	TempHumi 	26.0	52.0	20.7	1592535529
4709	TempHumi 	26.0	53.0	20.8	1592535539
4710	TempHumi 	26.0	53.0	20.8	1592535551
4711	TempHumi 	26.0	52.0	20.7	1592535560
4712	TempHumi 	26.0	53.0	20.8	1592535579
4713	TempHumi 	26.0	52.0	20.7	1592535589
4714	TempHumi 	26.0	52.0	20.7	1592535610
4715	TempHumi 	26.0	53.0	20.8	1592535621
4716	TempHumi 	26.0	52.0	20.7	1592535629
4717	TempHumi 	26.0	52.0	20.7	1592535639
4718	TempHumi 	26.0	53.0	20.8	1592535650
4719	TempHumi 	26.0	53.0	20.8	1592535660
4720	TempHumi 	26.0	51.0	20.7	1592536567
4721	TempHumi 	26.0	51.0	20.7	1592536577
4722	TempHumi 	26.0	51.0	20.7	1592536635
4723	TempHumi 	26.0	50.0	20.7	1592536696
4724	TempHumi 	26.0	51.0	20.7	1592536710
4725	TempHumi 	26.0	50.0	20.7	1592536717
4726	TempHumi 	26.0	51.0	20.7	1592536727
4727	TempHumi 	26.0	50.0	20.7	1592536738
4728	TempHumi 	26.0	51.0	20.7	1592536746
4729	TempHumi 	26.0	51.0	20.7	1592536756
4730	TempHumi 	26.0	51.0	20.7	1592536767
4731	TempHumi 	-999.0	-999.0	-1156.2	1592536777
4732	TempHumi 	26.0	51.0	20.7	1592536788
4733	TempHumi 	26.0	51.0	20.7	1592536796
4734	TempHumi 	26.0	51.0	20.7	1592536807
4735	TempHumi 	26.0	51.0	20.7	1592536817
4736	TempHumi 	26.0	52.0	20.7	1592536827
4737	TempHumi 	27.0	55.0	22.0	1592536838
4738	TempHumi 	28.0	56.0	23.1	1592536846
4739	TempHumi 	28.0	56.0	23.1	1592536856
4740	TempHumi 	28.0	56.0	23.1	1592536867
4741	TempHumi 	28.0	55.0	23.1	1592536877
4742	TempHumi 	28.0	55.0	23.1	1592536888
4743	TempHumi 	28.0	54.0	23.0	1592536898
4744	TempHumi 	28.0	54.0	23.0	1592536917
4745	TempHumi 	28.0	53.0	23.0	1592536928
4746	TempHumi 	28.0	53.0	23.0	1592536938
4747	TempHumi 	28.0	52.0	22.9	1592536949
4748	TempHumi 	28.0	52.0	22.9	1592536957
4749	TempHumi 	28.0	51.0	22.9	1592536967
4750	TempHumi 	28.0	51.0	22.9	1592536978
4751	TempHumi 	28.0	50.0	22.9	1592536988
4752	TempHumi 	28.0	50.0	22.9	1592536998
4753	TempHumi 	27.0	50.0	21.8	1592537007
4754	TempHumi 	27.0	50.0	21.8	1592537017
4755	TempHumi 	27.0	48.0	21.7	1592537057
4756	TempHumi 	26.0	49.0	20.6	1592537117
4757	TempHumi 	26.0	49.0	20.6	1592537128
4758	TempHumi 	26.0	49.0	20.6	1592537138
4759	TempHumi 	26.0	49.0	20.6	1592537149
\.


--
-- TOC entry 3317 (class 0 OID 26358)
-- Dependencies: 217
-- Data for Name: settings; Type: TABLE DATA; Schema: public; Owner: user_scc
--

COPY public.settings (settings_id, settings_name, settings_value, settings_group) FROM stdin;
5	time_update_heat_index	600	dashboard_settings
1	backup_log_system	true	system_settings
2	maintenance_system	false	system_settings
3	time_update_temp	600	dashboard_settings
4	time_update_humid	600	dashboard_settings
\.


--
-- TOC entry 3313 (class 0 OID 26336)
-- Dependencies: 213
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: user_scc
--

COPY public."user" (user_id, user_fullname, user_password, user_mobile, user_email, user_address, user_role, user_about, user_login_attempt, user_remember_token, user_lang, user_avatar, user_temporary_password) FROM stdin;
ep8SFLFSsveuXF0wIFUY	Huỳnh Ngọc Thiện	202cb962ac59075b964b07152d234b70	0888315899	thiendepwa21@yahoo.com	192 Bưởi Tí Phường Bến Nghé, Quận Tân Phước	Super Admin	Đây là admin. Hết !!!	0	ep8SFLFSsveuXF0wIFUY	us	../assets/users/avatar/ep8SFLFSsveuXF0wIFUY.jpeg	\N
\.


--
-- TOC entry 3331 (class 0 OID 0)
-- Dependencies: 205
-- Name: air_conditioner_id_seq; Type: SEQUENCE SET; Schema: public; Owner: user_scc
--

SELECT pg_catalog.setval('public.air_conditioner_id_seq', 47, true);


--
-- TOC entry 3332 (class 0 OID 0)
-- Dependencies: 204
-- Name: air_conditioner_seq; Type: SEQUENCE SET; Schema: public; Owner: user_scc
--

SELECT pg_catalog.setval('public.air_conditioner_seq', 1, false);


--
-- TOC entry 3333 (class 0 OID 0)
-- Dependencies: 220
-- Name: building_building_order_seq; Type: SEQUENCE SET; Schema: public; Owner: user_scc
--

SELECT pg_catalog.setval('public.building_building_order_seq', 15, true);


--
-- TOC entry 3334 (class 0 OID 0)
-- Dependencies: 203
-- Name: config_threshold_seq; Type: SEQUENCE SET; Schema: public; Owner: user_scc
--

SELECT pg_catalog.setval('public.config_threshold_seq', 1, false);


--
-- TOC entry 3335 (class 0 OID 0)
-- Dependencies: 211
-- Name: constant_constant_id_seq; Type: SEQUENCE SET; Schema: public; Owner: user_scc
--

SELECT pg_catalog.setval('public.constant_constant_id_seq', 1, false);


--
-- TOC entry 3336 (class 0 OID 0)
-- Dependencies: 222
-- Name: floor_floor_order_seq; Type: SEQUENCE SET; Schema: public; Owner: user_scc
--

SELECT pg_catalog.setval('public.floor_floor_order_seq', 5, true);


--
-- TOC entry 3337 (class 0 OID 0)
-- Dependencies: 215
-- Name: language_language_id_seq; Type: SEQUENCE SET; Schema: public; Owner: user_scc
--

SELECT pg_catalog.setval('public.language_language_id_seq', 1, false);


--
-- TOC entry 3338 (class 0 OID 0)
-- Dependencies: 218
-- Name: permission_permission_id_seq; Type: SEQUENCE SET; Schema: public; Owner: user_scc
--

SELECT pg_catalog.setval('public.permission_permission_id_seq', 7, true);


--
-- TOC entry 3339 (class 0 OID 0)
-- Dependencies: 224
-- Name: room_room_order_seq; Type: SEQUENCE SET; Schema: public; Owner: user_scc
--

SELECT pg_catalog.setval('public.room_room_order_seq', 2, true);


--
-- TOC entry 3340 (class 0 OID 0)
-- Dependencies: 216
-- Name: settings_settings_id_seq; Type: SEQUENCE SET; Schema: public; Owner: user_scc
--

SELECT pg_catalog.setval('public.settings_settings_id_seq', 1, false);


--
-- TOC entry 3341 (class 0 OID 0)
-- Dependencies: 207
-- Name: temp_humid_sensor_id_seq; Type: SEQUENCE SET; Schema: public; Owner: user_scc
--

SELECT pg_catalog.setval('public.temp_humid_sensor_id_seq', 4759, true);


--
-- TOC entry 3342 (class 0 OID 0)
-- Dependencies: 202
-- Name: temp_humid_sensor_seq; Type: SEQUENCE SET; Schema: public; Owner: user_scc
--

SELECT pg_catalog.setval('public.temp_humid_sensor_seq', 1, false);


-- Completed on 2020-06-19 16:38:26 +07

--
-- PostgreSQL database dump complete
--

