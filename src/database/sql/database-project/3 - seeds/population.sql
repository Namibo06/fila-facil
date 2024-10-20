USE db_fila_facil;

INSERT INTO tb_enterprise (cnpj, corporate_name, email, phone, profile_picture, sector, enterprise_password, token)
VALUES
('11111111000101', 'Empresa Saúde Viva', 'contato@saudeviva.com', '11987654321', 'saudeviva.jpg', 'Saúde', SHA2('senha123', 256), 'token1'),
('22222222000102', 'Tech Solutions', 'contato@techsolutions.com', '11987654322', 'techsolutions.jpg', 'Tecnólogia', SHA2('senha456', 256), 'token2'),
('33333333000103', 'Educare Educação', 'contato@educare.com', '11987654323', 'educare.jpg', 'Educação', SHA2('senha789', 256), 'token3'),
('44444444000104', 'Outros Serviços Ltda', 'contato@outrosltda.com', '11987654324', 'outrosltda.jpg', 'Outros', SHA2('senha101', 256), 'token4'),
('55555555000105', 'MediTech Saúde', 'contato@meditech.com', '11987654325', 'meditech.jpg', 'Saúde', SHA2('senha102', 256), 'token5');


INSERT INTO tb_user (user_id, user_name, email, phone, profile_picture, user_password, token)
VALUES
(UUID(), 'Ana Silva', 'ana.silva@gmail.com', '11999990001', 'ana.jpg', SHA2('senha123', 256), 'token_user1'),
(UUID(), 'Bruno Costa', 'bruno.costa@gmail.com', '11999990002', 'bruno.jpg', SHA2('senha456', 256), 'token_user2'),
(UUID(), 'Carla Souza', 'carla.souza@gmail.com', '11999990003', 'carla.jpg', SHA2('senha789', 256), 'token_user3'),
(UUID(), 'Daniel Lima', 'daniel.lima@gmail.com', '11999990004', 'daniel.jpg', SHA2('senha101', 256), 'token_user4'),
(UUID(), 'Eduardo Silva', 'eduardo.silva@gmail.com', '11999990005', 'eduardo.jpg', SHA2('senha102', 256), 'token_user5'),
(UUID(), 'Fernanda Oliveira', 'fernanda.oliveira@gmail.com', '11999990006', 'fernanda.jpg', SHA2('senha103', 256), 'token_user6'),
(UUID(), 'Gabriel Santos', 'gabriel.santos@gmail.com', '11999990007', 'gabriel.jpg', SHA2('senha104', 256), 'token_user7'),
(UUID(), 'Heloisa Mendes', 'heloisa.mendes@gmail.com', '11999990008', 'heloisa.jpg', SHA2('senha105', 256), 'token_user8'),
(UUID(), 'Igor Ferreira', 'igor.ferreira@gmail.com', '11999990009', 'igor.jpg', SHA2('senha106', 256), 'token_user9'),
(UUID(), 'Julia Lima', 'julia.lima@gmail.com', '11999990010', 'julia.jpg', SHA2('senha107', 256), 'token_user10'),
(UUID(), 'Kleber Teixeira', 'kleber.teixeira@gmail.com', '11999990011', 'kleber.jpg', SHA2('senha108', 256), 'token_user11'),
(UUID(), 'Laura Albuquerque', 'laura.albuquerque@gmail.com', '11999990012', 'laura.jpg', SHA2('senha109', 256), 'token_user12'),
(UUID(), 'Marcos Vieira', 'marcos.vieira@gmail.com', '11999990013', 'marcos.jpg', SHA2('senha110', 256), 'token_user13'),
(UUID(), 'Natalia Moreira', 'natalia.moreira@gmail.com', '11999990014', 'natalia.jpg', SHA2('senha111', 256), 'token_user14'),
(UUID(), 'Otavio Costa', 'otavio.costa@gmail.com', '11999990015', 'otavio.jpg', SHA2('senha112', 256), 'token_user15'),
(UUID(), 'Patricia Nunes', 'patricia.nunes@gmail.com', '11999990016', 'patricia.jpg', SHA2('senha113', 256), 'token_user16'),
(UUID(), 'Roberto Fonseca', 'roberto.fonseca@gmail.com', '11999990017', 'roberto.jpg', SHA2('senha114', 256), 'token_user17'),
(UUID(), 'Silvia Ramos', 'silvia.ramos@gmail.com', '11999990018', 'silvia.jpg', SHA2('senha115', 256), 'token_user18'),
(UUID(), 'Thiago Barros', 'thiago.barros@gmail.com', '11999990019', 'thiago.jpg', SHA2('senha116', 256), 'token_user19'),
(UUID(), 'Vanessa Lima', 'vanessa.lima@gmail.com', '11999990020', 'vanessa.jpg', SHA2('senha117', 256), 'token_user20');


INSERT INTO tb_event (event_id, event_name, enterprise_cpnj, number_chips, event_description, break_time, opening_time, closing_time)
VALUES
(UUID(), 'Congresso Médico 2024', '11111111000101', 300, 'Congresso anual de medicina com palestras internacionais.', '12:00:00', '2024-11-01 09:00:00', '2024-11-01 18:00:00'),
(UUID(), 'Tech Summit', '22222222000102', 500, 'O maior evento de tecnologia da América Latina.', '13:00:00', '2024-12-05 08:00:00', '2024-12-05 17:00:00'),
(UUID(), 'Seminário de Educação', '33333333000103', 150, 'Discussão sobre as novas tendências na educação.', '10:30:00', '2024-10-25 09:00:00', '2024-10-25 17:00:00'),
(UUID(), 'Workshop de Saúde', '11111111000101', 100, 'Evento de saúde com foco em bem-estar e prevenção.', '11:00:00', '2024-11-15 10:00:00', '2024-11-15 16:00:00'),
(UUID(), 'Feira de Inovação Tecnológica', '22222222000102', 400, 'Evento para exibição de inovações no setor de tecnologia.', '14:00:00', '2024-11-20 09:00:00', '2024-11-20 19:00:00'),
(UUID(), 'Conferência de Educação', '33333333000103', 200, 'Conferência internacional sobre novas metodologias educacionais.', '12:00:00', '2024-12-10 08:00:00', '2024-12-10 16:00:00'),
(UUID(), 'Hackathon Tech', '22222222000102', 350, 'Competição de programação com prêmios para os melhores projetos.', '12:00:00', '2024-10-30 08:00:00', '2024-10-30 20:00:00'),
(UUID(), 'Seminário de Saúde Preventiva', '11111111000101', 120, 'Palestras sobre prevenção de doenças crônicas.', '11:00:00', '2024-11-12 09:00:00', '2024-11-12 17:00:00'),
(UUID(), 'Encontro de Startups', '22222222000102', 250, 'Reunião de startups para discutir novas tecnologias.', '12:30:00', '2024-12-15 09:00:00', '2024-12-15 18:00:00'),
(UUID(), 'Congresso de Educação Infantil', '33333333000103', 180, 'Discussão sobre educação infantil e primeiros anos de ensino.', '11:00:00', '2024-12-01 08:00:00', '2024-12-01 16:00:00');


INSERT INTO tb_favorite (favorite_id, event_id)
VALUES
(UUID(), (SELECT event_id FROM tb_event WHERE event_name = 'Congresso Médico 2024')),
(UUID(), (SELECT event_id FROM tb_event WHERE event_name = 'Tech Summit')),
(UUID(), (SELECT event_id FROM tb_event WHERE event_name = 'Seminário de Educação')),
(UUID(), (SELECT event_id FROM tb_event WHERE event_name = 'Workshop de Saúde')),
(UUID(), (SELECT event_id FROM tb_event WHERE event_name = 'Feira de Inovação Tecnológica')),
(UUID(), (SELECT event_id FROM tb_event WHERE event_name = 'Conferência de Educação')),
(UUID(), (SELECT event_id FROM tb_event WHERE event_name = 'Hackathon Tech')),
(UUID(), (SELECT event_id FROM tb_event WHERE event_name = 'Seminário de Saúde Preventiva')),
(UUID(), (SELECT event_id FROM tb_event WHERE event_name = 'Encontro de Startups')),
(UUID(), (SELECT event_id FROM tb_event WHERE event_name = 'Congresso de Educação Infantil'));


INSERT INTO tb_image (image_id, image_name)
VALUES
(UUID(), 'evento1.jpg'),
(UUID(), 'evento2.jpg'),
(UUID(), 'evento3.jpg'),
(UUID(), 'evento4.jpg'),
(UUID(), 'evento5.jpg'),
(UUID(), 'evento6.jpg'),
(UUID(), 'evento7.jpg'),
(UUID(), 'evento8.jpg'),
(UUID(), 'evento9.jpg'),
(UUID(), 'evento10.jpg');


INSERT INTO tb_address (cep, state, city, neighborhood, street)
VALUES
('01001001', 'SP', 'São Paulo', 'Centro', 'Praça da Sé'),
('02002001', 'SP', 'São Paulo', 'Santana', 'Rua Dr. Olavo Egídio'),
('03003001', 'SP', 'São Paulo', 'Mooca', 'Rua dos Trilhos'),
('04004001', 'RJ', 'Rio de Janeiro', 'Copacabana', 'Avenida Atlântica'),
('05005001', 'RJ', 'Rio de Janeiro', 'Barra da Tijuca', 'Avenida das Américas'),
('06006001', 'MG', 'Belo Horizonte', 'Savassi', 'Rua Pernambuco'),
('07007001', 'BA', 'Salvador', 'Pelourinho', 'Ladeira do Carmo'),
('08008001', 'RS', 'Porto Alegre', 'Centro Histórico', 'Rua dos Andradas'),
('09009001', 'PR', 'Curitiba', 'Batel', 'Avenida Batel'),
('10010001', 'PE', 'Recife', 'Boa Viagem', 'Avenida Boa Viagem');



INSERT INTO tb_user_address (cep, user_id, residential_number, complement)
VALUES
('06006001', (SELECT user_id FROM tb_user WHERE email = 'ana.silva@gmail.com'), '101', 'Bloco A'),
('07007001', (SELECT user_id FROM tb_user WHERE email = 'bruno.costa@gmail.com'), '202', 'Bloco B'),
('08008001', (SELECT user_id FROM tb_user WHERE email = 'carla.souza@gmail.com'), '303', 'Bloco C'),
('09009001', (SELECT user_id FROM tb_user WHERE email = 'daniel.lima@gmail.com'), '404', 'Bloco D'),
('10010001', (SELECT user_id FROM tb_user WHERE email = 'eduardo.silva@gmail.com'), '505', 'Bloco E'),
('01001001', (SELECT user_id FROM tb_user WHERE email = 'fernanda.oliveira@gmail.com'), '606', 'Casa'),
('02002001', (SELECT user_id FROM tb_user WHERE email = 'gabriel.santos@gmail.com'), '707', 'Casa'),
('03003001', (SELECT user_id FROM tb_user WHERE email = 'heloisa.mendes@gmail.com'), '808', 'Casa'),
('04004001', (SELECT user_id FROM tb_user WHERE email = 'igor.ferreira@gmail.com'), '909', 'Casa'),
('05005001', (SELECT user_id FROM tb_user WHERE email = 'julia.lima@gmail.com'), '1010', 'Casa');

INSERT INTO tb_enterprise_address (cep, enterprise_cpnj, residential_number, complement)
VALUES
('01001001', '11111111000101', '100', 'Edifício Central'),
('02002001', '22222222000102', '250', 'Sala 12B'),
('03003001', '33333333000103', '350', 'Andar 5'),
('04004001', '44444444000104', '400', 'Prédio A'),
('05005001', '55555555000105', '500', 'Cobertura');
