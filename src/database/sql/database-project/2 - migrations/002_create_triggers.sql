USE db_fila_facil;


DELIMITER $$
/*Quando um evento é excluído, garante que as imagens e as favoritos associadas ao evento também sejam excluídas automaticamente.*/

CREATE TRIGGER IF NOT EXISTS after_event_delete
AFTER DELETE ON tb_event
FOR EACH ROW
BEGIN
    DELETE FROM tb_event_image WHERE event_id = OLD.event_id;
    DELETE FROM tb_favorite WHERE event_id = OLD.event_id;
END$$

DELIMITER ;



DELIMITER $$
/*Evita a criação de eventos com um número de chips inválido*/

CREATE TRIGGER IF NOT EXISTS before_event_insert
BEFORE INSERT ON tb_event
FOR EACH ROW
BEGIN
    IF NEW.number_chips <= 0 THEN
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'O número de chips deve ser maior que zero.';
    END IF;
END$$

DELIMITER ;

DELIMITER $$

/*Evita a atualização de eventos com um número de chips inválido*/
CREATE TRIGGER IF NOT EXISTS before_event_update
BEFORE UPDATE ON tb_event
FOR EACH ROW
BEGIN
    IF NEW.number_chips <= 0 THEN
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'O número de chips deve ser maior que zero.';
    END IF;
END;

DELIMITER ;