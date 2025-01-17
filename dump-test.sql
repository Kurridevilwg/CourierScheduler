PGDMP  5                    |            test    16.1    16.1     �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            �           1262    16453    test    DATABASE     x   CREATE DATABASE test WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Russian_Russia.1251';
    DROP DATABASE test;
                postgres    false                        2615    2200    public    SCHEMA        CREATE SCHEMA public;
    DROP SCHEMA public;
                pg_database_owner    false                        0    0    SCHEMA public    COMMENT     6   COMMENT ON SCHEMA public IS 'standard public schema';
                   pg_database_owner    false    4            �            1259    125303    couriers    TABLE     d   CREATE TABLE public.couriers (
    id integer NOT NULL,
    name character varying(255) NOT NULL
);
    DROP TABLE public.couriers;
       public         heap    postgres    false    4            �            1259    125302    couriers_id_seq    SEQUENCE     �   CREATE SEQUENCE public.couriers_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.couriers_id_seq;
       public          postgres    false    4    218                       0    0    couriers_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.couriers_id_seq OWNED BY public.couriers.id;
          public          postgres    false    217            �            1259    125296    regions    TABLE     �   CREATE TABLE public.regions (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    travel_time integer NOT NULL
);
    DROP TABLE public.regions;
       public         heap    postgres    false    4            �            1259    125295    regions_id_seq    SEQUENCE     �   CREATE SEQUENCE public.regions_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.regions_id_seq;
       public          postgres    false    216    4                       0    0    regions_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public.regions_id_seq OWNED BY public.regions.id;
          public          postgres    false    215            �            1259    125310    trips    TABLE     �   CREATE TABLE public.trips (
    id integer NOT NULL,
    region_id integer NOT NULL,
    courier_id integer NOT NULL,
    departure_date date NOT NULL,
    arrival_date date NOT NULL,
    return_date date NOT NULL
);
    DROP TABLE public.trips;
       public         heap    postgres    false    4            �            1259    125309    trips_id_seq    SEQUENCE     �   CREATE SEQUENCE public.trips_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.trips_id_seq;
       public          postgres    false    4    220                       0    0    trips_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.trips_id_seq OWNED BY public.trips.id;
          public          postgres    false    219            [           2604    125306    couriers id    DEFAULT     j   ALTER TABLE ONLY public.couriers ALTER COLUMN id SET DEFAULT nextval('public.couriers_id_seq'::regclass);
 :   ALTER TABLE public.couriers ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    217    218    218            Z           2604    125299 
   regions id    DEFAULT     h   ALTER TABLE ONLY public.regions ALTER COLUMN id SET DEFAULT nextval('public.regions_id_seq'::regclass);
 9   ALTER TABLE public.regions ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    216    215    216            \           2604    125313    trips id    DEFAULT     d   ALTER TABLE ONLY public.trips ALTER COLUMN id SET DEFAULT nextval('public.trips_id_seq'::regclass);
 7   ALTER TABLE public.trips ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    220    219    220            �          0    125303    couriers 
   TABLE DATA           ,   COPY public.couriers (id, name) FROM stdin;
    public          postgres    false    218   �       �          0    125296    regions 
   TABLE DATA           8   COPY public.regions (id, name, travel_time) FROM stdin;
    public          postgres    false    216   �       �          0    125310    trips 
   TABLE DATA           e   COPY public.trips (id, region_id, courier_id, departure_date, arrival_date, return_date) FROM stdin;
    public          postgres    false    220   p                  0    0    couriers_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.couriers_id_seq', 10, true);
          public          postgres    false    217                       0    0    regions_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.regions_id_seq', 10, true);
          public          postgres    false    215                       0    0    trips_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.trips_id_seq', 384, true);
          public          postgres    false    219            `           2606    125308    couriers couriers_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.couriers
    ADD CONSTRAINT couriers_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.couriers DROP CONSTRAINT couriers_pkey;
       public            postgres    false    218            ^           2606    125301    regions regions_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.regions
    ADD CONSTRAINT regions_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.regions DROP CONSTRAINT regions_pkey;
       public            postgres    false    216            b           2606    125315    trips trips_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.trips
    ADD CONSTRAINT trips_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.trips DROP CONSTRAINT trips_pkey;
       public            postgres    false    220            c           2606    125321    trips trips_courier_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.trips
    ADD CONSTRAINT trips_courier_id_fkey FOREIGN KEY (courier_id) REFERENCES public.couriers(id);
 E   ALTER TABLE ONLY public.trips DROP CONSTRAINT trips_courier_id_fkey;
       public          postgres    false    4704    218    220            d           2606    125316    trips trips_region_id_fkey    FK CONSTRAINT     }   ALTER TABLE ONLY public.trips
    ADD CONSTRAINT trips_region_id_fkey FOREIGN KEY (region_id) REFERENCES public.regions(id);
 D   ALTER TABLE ONLY public.trips DROP CONSTRAINT trips_region_id_fkey;
       public          postgres    false    4702    216    220            �     x�UPAN�0<ۯ��P�/<��^*U U��*/0i�$5_��Y�$��d�3;3��J�����`�#Z?�%G��|�����RX�&=��%�#�����M����_�a'���Q��l�#*��M���B���dÁ��K��gkI�"��h[���n⠞(�,�_��X�S�m�u���r��6f���;�/�B4��<�9J�B�^�F��q���h��q��.�A)ףK�O����_F��3��;�m
Y%����/FV�      �   �   x�5���@E�v4 "K/�8 $.H!�4�$5|w�O��4����'x E�ڒ)�(-��k.�����J�������{�O�9:�
�4�� ��Y�f$���Z2p]�.�H�<G�?3��0�l�3*V��ӢDE���9ml��ys�iLI��_eG�t3S�/��      �     x���]��
�����Y������o�b�8>YH@�B�|�cבS�?����fv����������~�%`�G}�nV7���i|�+�Y����n����	���ٿf�؏`v��wQ��#����'7-����#s}��ҳ��>e7��
&�2݃�L���?��`�I���s�}�����K�</��e�ZK��}�Oe6!�Q�N�p�����𰇇=~�J$8
�7-�y����%���,��@�3�`���<�/��Wb����V26���
����z3d%���f ����|,��O0�[�eX�u�@Rח��YH���g���Z�tnZ���^��;�ްã6>x����{������n�[�2���%7�c0
-UU�qL /�%��_����BUŞ��pf���<�$���cq"Y0����t/��6�!���馈�L�H₥j�V�G*������������z&äN8������1�i{|�tp���D+�= ����-g����y���nM�M�e�ڜ^�Ra�zT !�����4 �tBQ5���4!2ҐCE���p�e��E����(��9%h$d򡋠��<F]�Wmr�^��wGAʇG���XQ�p�S���a���q�|�	���#x�V	8��׃�"h���m�V�y���vڜw����&}3� ���7-;��7��ΐ1��M@��{�Q�l�,ͷqs��۸9'���&�Z�<>j���+!���[�4��=�W>L�ߘ�K��f�8^C8ųe�0�0���ث�c�R̠����Uߢ65C+�r�eM����k���M�Β���-'Y��e�oJJ���}��mM@�-�ͅ�S@V��Q�s[�:�j_��g��S��X���h�8��N�`	_�cl.�J��P�0���G�sȫ�%�Ӕ�zʽ뙢�e��� �U��,�5m �y���~	ؼ<�p ��Y �8�G�ӯ�QG��v���t�5�m^������vsf�g#��=���syh����a;�q��{��	L;NM�8��Ǚ�Wn.��hoq����e�����J �
��G;h�	S��bC��!Z�=n)^z�$�.�]7D`+�QC⃞hs3nwh �C����k�3�?y���eB*5�@��*a-���^j��Q�~ pK���D���gG��	�3����ɋ�<c	� ݤ6+�-�bܬZe �=��fo�����c	Ko/��~ ���4�{��û]i�t��ɹ��)�jo�Xrp �����_��KO&�)��c���a���`O��2������\JK� �C��a�i3��n�ѽI��/{;�tKϵ����B�d�p_HЮ�{+��)�H���6�nf���'���`��V!"��n*�Q�����f[�q��<�>:W�l� #�`�r�&r2��7a!�����,3��Ý�M��} �g;A3�Ƌ/�C	��H_^�ˬ>��s9���y��+��`     