USE db_fila_facil;

DELIMITER $$

CREATE PROCEDURE insert_user_info(

    /* Parâmetros da tabela tb_user */
    IN p_user_id CHAR(36),
    IN p_user_name VARCHAR(45),
    IN p_email VARCHAR(64),
    IN p_phone CHAR(11),
    IN p_profile_picture VARCHAR(50),
    IN p_user_password VARCHAR(256),
    IN p_token VARCHAR(100),
    
    /* Parâmetros da tabela tb_address */
    IN p_state CHAR(2),
    IN p_cep CHAR(8),
    IN p_city VARCHAR(50),
    IN p_neighborhood VARCHAR(50),
    IN p_street VARCHAR(100),
    
    /* Parâmetros da tabela tb_user_address */
    IN p_residential_number VARCHAR(10),
    IN p_complement VARCHAR(255)
)
BEGIN
    DECLARE v_cep CHAR(8);  -- Mudei para CHAR(8) para corresponder ao tipo da tabela
    
    START TRANSACTION;

    -- Inserir usuário
    INSERT INTO tb_user (user_id, user_name, email, phone, profile_picture, user_password, token)
    VALUES (p_user_id, p_user_name, p_email, p_phone, p_profile_picture, p_user_password, p_token);
    
    -- Verificar se já existe um endereço comum com o CEP, cidade, bairro e rua
    SELECT cep INTO v_cep
    FROM tb_address
    WHERE cep = p_cep AND state = p_state AND city = p_city AND neighborhood = p_neighborhood AND street = p_street;
    
    -- Se o endereço comum não existir, insira-o
    IF v_cep IS NULL THEN
        INSERT INTO tb_address (cep, state, city, neighborhood, street)
        VALUES (p_cep, p_state, p_city, p_neighborhood, p_street);
        
        SET v_cep = p_cep;  -- Aqui, você pode manter o valor de p_cep, pois é o mesmo
    END IF;

    -- Inserir o endereço específico do usuário
    INSERT INTO tb_user_address (user_id, cep, residential_number, complement)
    VALUES (p_user_id, v_cep, p_residential_number, p_complement);
    
    COMMIT;
END$$

DELIMITER ;
