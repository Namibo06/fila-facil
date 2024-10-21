USE db_fila_facil

DELIMITER $$

CREATE TRIGGER before_sold_ticket_insert
BEFORE INSERT ON tb_event_user
FOR EACH ROW
BEGIN
    DECLARE quantidade_disponivel INT;
    DECLARE quantidade_vendida INT;

    -- Buscar a quantidade disponível no estoque
    SELECT E.avaliable_tickets INTO quantidade_disponivel
    FROM tb_event AS E
    WHERE E.event_id = NEW.event_id;
    
    SET quantidade_vendida = NEW.sold_ticket;
    
   -- Verificar se a quantidade vendida é maior ou igual a 0
   IF (quantidade_vendida >= 0) THEN
   	-- Verificar se há quantidade suficiente
   	IF (quantidade_disponivel < quantidade_vendida) THEN   
			SIGNAL SQLSTATE '45000' 
      	SET MESSAGE_TEXT = 'Quantidade insuficiente'; 
    	ELSE
        -- Diminuir a quantidade no estoque
        UPDATE tb_event
        SET avaliable_tickets = avaliable_tickets - quantidade_vendida
        WHERE event_id = NEW.event_id;
        
    	END IF;
    	
   ELSE
   	SIGNAL SQLSTATE '45000' 
   	SET MESSAGE_TEXT = 'Não pode ser uma quantidade negativa';
	END IF; 
END$$

DELIMITER ;
