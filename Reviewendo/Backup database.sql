PGDMP                         {           tsw    15.2    15.2                0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false                       0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false                       0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false                       1262    16793    tsw    DATABASE     v   CREATE DATABASE tsw WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Italian_Italy.1252';
    DROP DATABASE tsw;
                postgres    false            �            1255    17324    aggiorna_recensioni()    FUNCTION     I  CREATE FUNCTION public.aggiorna_recensioni() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
DECLARE
    media_voti DECIMAL(3,2);
BEGIN
    -- Aggiorna il numero di recensioni incrementandolo di 1
    UPDATE libri
    SET num_recensioni = num_recensioni + 1
    WHERE ISBN = NEW.libro;

    -- Calcola la media dei voti delle recensioni sul libro
    SELECT AVG(voto) INTO media_voti
    FROM recensioni
    WHERE libro = NEW.libro;

    -- Aggiorna la colonna voto con la media calcolata
    UPDATE libri
    SET voto = media_voti
    WHERE ISBN = NEW.libro;

    RETURN NEW;
END;
$$;
 ,   DROP FUNCTION public.aggiorna_recensioni();
       public          postgres    false                       0    0    FUNCTION aggiorna_recensioni()    ACL     M   GRANT ALL ON FUNCTION public.aggiorna_recensioni() TO www WITH GRANT OPTION;
          public          postgres    false    217            �            1255    17395    decrementa_recensioni()    FUNCTION     L  CREATE FUNCTION public.decrementa_recensioni() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
DECLARE
    media_voti DECIMAL(3,2);
BEGIN
    -- Aggiorna il numero di recensioni incrementandolo di 1
    UPDATE libri
    SET num_recensioni = num_recensioni - 1
    WHERE ISBN = OLD.libro;

    -- Calcola la media dei voti delle recensioni sul libro
    SELECT AVG(voto) INTO media_voti
    FROM recensioni
    WHERE libro = OLD.libro;

    -- Aggiorna la colonna voto con la media calcolata
    UPDATE libri
    SET voto = media_voti
    WHERE ISBN = OLD.libro;

    RETURN null;
END;
$$;
 .   DROP FUNCTION public.decrementa_recensioni();
       public          postgres    false                       0    0     FUNCTION decrementa_recensioni()    ACL     O   GRANT ALL ON FUNCTION public.decrementa_recensioni() TO www WITH GRANT OPTION;
          public          postgres    false    229            �            1259    17549    libri    TABLE     �  CREATE TABLE public.libri (
    titolo character varying(50) NOT NULL,
    isbn character(13) NOT NULL,
    copertina character varying(40),
    genere character varying(20),
    descrizione character varying(600),
    pagine integer NOT NULL,
    autore character varying(30) NOT NULL,
    editore character varying(20) NOT NULL,
    anno integer,
    prezzo numeric(5,2) NOT NULL,
    num_recensioni integer DEFAULT 0,
    voto numeric(3,2) DEFAULT 0.0
);
    DROP TABLE public.libri;
       public         heap    postgres    false                       0    0    TABLE libri    ACL     (   GRANT ALL ON TABLE public.libri TO www;
          public          postgres    false    214            �            1259    17567 
   recensioni    TABLE     �   CREATE TABLE public.recensioni (
    libro character(13) NOT NULL,
    utente character varying(20) NOT NULL,
    nome character varying(20),
    contenuto character varying(500),
    voto integer NOT NULL,
    data_inserimento date NOT NULL
);
    DROP TABLE public.recensioni;
       public         heap    postgres    false                       0    0    TABLE recensioni    ACL     -   GRANT ALL ON TABLE public.recensioni TO www;
          public          postgres    false    216            �            1259    17558    utenti    TABLE     5  CREATE TABLE public.utenti (
    nome character varying(20),
    cognome character varying(20),
    nickname character varying(20) NOT NULL,
    mail character varying(40) NOT NULL,
    passwd character varying(255) NOT NULL,
    risposta character varying(255) NOT NULL,
    data_di_nascita date NOT NULL
);
    DROP TABLE public.utenti;
       public         heap    postgres    false                       0    0    TABLE utenti    ACL     )   GRANT ALL ON TABLE public.utenti TO www;
          public          postgres    false    215                      0    17549    libri 
   TABLE DATA           �   COPY public.libri (titolo, isbn, copertina, genere, descrizione, pagine, autore, editore, anno, prezzo, num_recensioni, voto) FROM stdin;
    public          postgres    false    214   �"                 0    17567 
   recensioni 
   TABLE DATA           \   COPY public.recensioni (libro, utente, nome, contenuto, voto, data_inserimento) FROM stdin;
    public          postgres    false    216   �7                 0    17558    utenti 
   TABLE DATA           b   COPY public.utenti (nome, cognome, nickname, mail, passwd, risposta, data_di_nascita) FROM stdin;
    public          postgres    false    215   �7       s           2606    17557    libri libri_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.libri
    ADD CONSTRAINT libri_pkey PRIMARY KEY (isbn);
 :   ALTER TABLE ONLY public.libri DROP CONSTRAINT libri_pkey;
       public            postgres    false    214            y           2606    17573    recensioni recensioni_pkey 
   CONSTRAINT     c   ALTER TABLE ONLY public.recensioni
    ADD CONSTRAINT recensioni_pkey PRIMARY KEY (libro, utente);
 D   ALTER TABLE ONLY public.recensioni DROP CONSTRAINT recensioni_pkey;
       public            postgres    false    216    216            u           2606    17566    utenti utenti_nickname_key 
   CONSTRAINT     Y   ALTER TABLE ONLY public.utenti
    ADD CONSTRAINT utenti_nickname_key UNIQUE (nickname);
 D   ALTER TABLE ONLY public.utenti DROP CONSTRAINT utenti_nickname_key;
       public            postgres    false    215            w           2606    17564    utenti utenti_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.utenti
    ADD CONSTRAINT utenti_pkey PRIMARY KEY (mail);
 <   ALTER TABLE ONLY public.utenti DROP CONSTRAINT utenti_pkey;
       public            postgres    false    215            |           2620    17584 &   recensioni trigger_aggiorna_recensioni    TRIGGER     �   CREATE TRIGGER trigger_aggiorna_recensioni AFTER INSERT ON public.recensioni FOR EACH ROW EXECUTE FUNCTION public.aggiorna_recensioni();
 ?   DROP TRIGGER trigger_aggiorna_recensioni ON public.recensioni;
       public          postgres    false    217    216            }           2620    17585 (   recensioni trigger_decrementa_recensioni    TRIGGER     �   CREATE TRIGGER trigger_decrementa_recensioni AFTER DELETE ON public.recensioni FOR EACH ROW EXECUTE FUNCTION public.decrementa_recensioni();
 A   DROP TRIGGER trigger_decrementa_recensioni ON public.recensioni;
       public          postgres    false    216    229            z           2606    17574     recensioni recensioni_libro_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.recensioni
    ADD CONSTRAINT recensioni_libro_fkey FOREIGN KEY (libro) REFERENCES public.libri(isbn) ON UPDATE CASCADE ON DELETE CASCADE;
 J   ALTER TABLE ONLY public.recensioni DROP CONSTRAINT recensioni_libro_fkey;
       public          postgres    false    214    216    3187            {           2606    17579 !   recensioni recensioni_utente_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.recensioni
    ADD CONSTRAINT recensioni_utente_fkey FOREIGN KEY (utente) REFERENCES public.utenti(nickname) ON UPDATE CASCADE ON DELETE CASCADE;
 K   ALTER TABLE ONLY public.recensioni DROP CONSTRAINT recensioni_utente_fkey;
       public          postgres    false    215    216    3189            �           826    16796     DEFAULT PRIVILEGES FOR FUNCTIONS    DEFAULT ACL     ]   ALTER DEFAULT PRIVILEGES FOR ROLE postgres GRANT ALL ON FUNCTIONS  TO www WITH GRANT OPTION;
                   postgres    false            �           826    16795    DEFAULT PRIVILEGES FOR TABLES    DEFAULT ACL     H   ALTER DEFAULT PRIVILEGES FOR ROLE postgres GRANT ALL ON TABLES  TO www;
                   postgres    false                  x�uZM��Hr=s~EB�R(����a�jI3����%`��EfU�E2k�d��Ns�_0`{��>�f�6�'�K�^D�����V�LfF�x�"����Me�l��l6��z�����m8����������?�ٷ!����n�3�4]��V>ǟ�����ƙҚS(�'o�g�bn�>�ڵ>��w#�ֶ�ya�GG\��:���]����\��㚼����k�o���_�xn��b[�ܹ�~�y�C�q�w�7�6��N�i-v�Sg�<4XЛ�WE���x{>�D5V��X7pc���������8��Ė��^jSv���"ߍ߰ܞ&�9��ò��5����^p�n��t;�^��`q�6ă��Y�쵭;���&�M6��7�l�MƓ�W��е���ԍ��d��ͷ7o��C���6���zN+Ѿ8�6�uS��pm��	,�]�	F,��s_�aR�m���y��J������ʵ��|im�,f�s(7�4Ea��b�6�3�e�~C�r��y �
�����G�̝���P������������Ђ�2�������a��~�`j�����8[�'�}�NGW�?����c�x�`����;�a���ec����d�\������������E��_H�_#���a'FY	�G߆����v e8wpZ$�q���)K{@��� �	�����X�1"��B�P��y'p�U�RZ�?a�. *l������0�8c<=��Wk��Ѥ%��T�4N1DK_bk*�0rP�a����?M	+ ��J�36�8$���1�B�Ξ�kC��]�t�b]A yt�g�@@�8��ُ]�7/a����7�&�b��x�/�7%�#D��,���v���w��'~}�d�m��_�ז�T�rJa�	>�[0QU	�y�������C�6E ؃��I��<E���ܡ�}�Ԉ1�be쬑xf��<?�E�u�ś`@ ��շW����#�X����yNX��P$�x�n<Ya������^��XqU`���N6�&�v!�^���;�y4�V�A�={���T�ZO��c�P.u@d|0�b2�I�hZ�Ɏ�m������	�:�6�;�7�荤�gOq�a@瞺ݮD� I0�-(d1���������-����l>��'F�w���7����Ͷ��j�<�+f���|�0st?9ث%�XG&c��%�Ѷ���H/$�5��<��I�̥B{qR܉$~�S+�t5|��$M��\�� '{�d�;�'x����_��#5���dt�yS�ɵM�(�e��F\���.�9����$*��)���K4�5��\�@: w3���Y܈�s�و��̲���W8zW���l
ǭ{ǽ��S����z:���Ӂ۾���>�`lW�>��0�� �OH�z��g"�F�N��ś3N�\��z&ĕʷ
��D�"~�۟:�<��ZZ8(/xƙ= u Gp\<3gv46�{q��hZ/��wd��!G�zb��KEK6��C���GFwE���c�CI]i�7��]M���#�iE�Ƚ�N���)�� �ƞ#�(��#�F̷�f�Ƞ<F�A�RD�!���=3�6�ࡻR�m�!vP02t�ǿ�o6�L�,���yx�� &�wP@PZ&i��x����D.�v���v2��M�.�y�1�_���L�4���s}S��ŀM	��DO���� � rgc�C�Q_�i��a�$��s����}׶do���)3�� �S�$Q�IN#'u'�� ; �P��#��4�*��\�Q�ϓ�J���`-�`�`%��K;�c3#��fٝe�R�ٝwU唆���v����݉0%R ޾]o7��d>]�6��W~���>zC�O��>%�bïJK�ƷL���H��v����9�mS*-�,޺�&%c$iK[�~T���4v��p�����u%;`�9�k �?�
�����z_��X��IT�ȝ�W���N\L�h#�:0�&��09%$�L]00�4�N���#�~�4TЯ6��v���0������\��A��jLa�:ΐ{�b��9��+�d�y5�yR���k9w�y�
��L0�Gu קc��u(1�s�J���JI	������s�ܢ�5FI~�Q�?QШ��-�$�.����%q�`��U�p���[�Yt�}����S
Sd�ʋ�)�k��[�j+��:Z��M�F�Rч,Z�d��@������tqy�	U�����!�,)\�oEkM�WH�����^ukol�D�����ں���P��O�O��t:� �V*fQ��C��%u/7��f��߸W�xsyr�]�F��~_�- s�'-�ٻP���,I3���6L]�5�jÜ�g���(�Re,'IA����"�	�wo�K���s�P�{��K��q��ĖX��S�,K�yi�ȣ>e{=:P�����噲��Id��GⰗ� ��*��G�������^z.CO�w��5?��e�'O%��x9��b(����Wm��r��>��w?���QE��Il��偗��~%ԙ9U�H�3ӣբ�_�U�}y*������@��p�}����X�G*��"��ꈨ
N���I���RK��83M����d�sqM��Ul�	8p��I�Ŋ)����N�-��H�pF����"j46j��d�~�Ӥ�Օ}�)BߐyKÕ%�*��*^�j�kAM�8�,	���K�p'�c�rY�6PTzw^�;�z�� ��gYh�҇����ٳ6�ũ��VE�9*?w^�y�-�
��/ �D9�w���t�0������cX9�}j%@�,��ⱺ{r�D�HY��+R 4 ݔ�sK��,!LBc����zo�O�|�`�B-@U��E<Y��d�y1�l%�(����F�^ŝ�~�>�ki�[x��aN܋|�1vZ4�`9Yҽ�H�rφ���f��)UT?��Rb ��>�𔠙&���gW��b�+�y[

����r?"y:��E^�lR�K9�`��j�DCG�{��a*��^�F�Q��$ڰ$� �L�MRr8�'Y�ǖ{�:/���漈>q$��t�}C���\��˾�SR�x6�..��aˣ�Y,��\-g�a|���׈�m
��ڱ��*Oz�����;lY4�L`4f��Ha{�D�/=H��*��P/=���j��u��d	)6)���AaMB�D�7ʘ��S����oU� ��|���}'�����ݱ���� ̴>=JRR��8�Yp��X�F}�X�/WG�v����$P����g�������g#Qh�z}��<�Z���<��M1��D�������ku�J��U����Jj�;r�6h��c��n��V�,U� �@P�]��3��՚N4���"�b�[a��\��~��S��B:�H�e��k:[n���z;��Mz`�%4o�A*f�C ſtj����;=�(`ţ�خ;x�z�ٕ�2���{�b�4��������i��M!D����߹�Al~<��	=O�v@7R�ښ��[�$mz����q�,o��LO2D�Qr��_iS?Uq����qg��1�R��Û��z�8C�4Ҁ?J+vo��+�x(}?�k�&I�N��_DG��N�,RLZ���\j%���	����-pTO����t5�\z�7u}m���Gmz^��S�>g�����Ju�A�B��@h�R���,񝴛8^��b�n���h�q�)a�R�!�Y޽�V�F���A�:��"�2v�2���U��z0��1�0�d���s�3p	�FP��\�?6�Г��kf1�(�gH�X�=4.���P�WfT�ؗT�V�ķ�rz\Y��%��R�V����
(�Q ;�3E�{T%��b墳�^��Z�⥃*��8�C"0߆���5��r���	�n�����wW�|�Y�����nQ*��#�F��� S;��� ���[`�, � �H}D�x�JB��E�#ߖ�'�5&9�.5p�u��A�S��x�A.����%g��;=R-Id�@<�o^���sȰ�+Z���Xg�`?��� �  �o��ӯ?����c�m�-����x}���>d����uoe\5����3_.' �������S�>3�6���dD��|*B|�]�i�RA�C�CLb�N�t�4�W�f���7�'�����N[�=e0o�9;fxv���>�����Ğ�-��4��g :�&��R'+��E�'Ҋ}����FM�,ADHS��W�f�����<�2D(�>�HC�=�j�gۦ� V���	'��I�<��R3��>g`d��5|���M�}<�s������W�	��$����BW�����o d1D�f�� 6�eh�(��P�t)ճ�'�Xh^^w���{��ޱQ�#5ikp��~'�X��R�B�G7곰��e��l$5�к��Q�K,�8�uU9����~5bʩ�g���^WkC���;�ȩ[h�P��"����7*-��Ҿ��.��7���Q&���WN2��.hJ���j�[�%�N_�x��ŷ�Hͅ�Wõ�خ��7��C�:�����Î�$ � 5���3ur
����׉��aΤ�B�(cHL�0��^��ғ���r�y�lN2�[�{ݥx��z���Y�����x�;Xe�%L2���\��R���IXg��χS�&���@X�8��𥩃0fd&�KKo$�7��B��{���22DnUD9�6�U��߉�j��j!h����^��b�;Ă38ϩ�K���j����,gW��c7�E�c��r�ǖk��8�(�����2I_,7��z�x���ÑB��F��a������u������K�V�X��!�M��jɮmT���C�j�,�j
��\��QF.O�f+�G��#YW"l����}{�vC�^2�[{b;�;�g��|�M6��wg�ۨ����l���=8��f�
~$��'�D�9�X!M�M�X��V��(��~d��_0�rj��7a��.�<h.Ѥ��x	��g
vc�a�fĒ��2����s�u� ��(� �Y���#��6Zl��y
�G�fT������l����8<5|j��]?�gU��H��QvP����p���&e�����y�t�`� S���1�J����f�u�xx+Z��'6G6�$%��F�]!e�^��� �,ӿ!�9�Ŧ��*]�ɇT(�\Q�q��ns�P�%"��]O�"��r+i���?!�\��J��{��X�k�C�R�Oږ��=0sy��:XȒ�}���|��#��.��2�>�u�lX�LA}t�|�[z2m���W_}�'�Tm            x������ � �            x������ � �     