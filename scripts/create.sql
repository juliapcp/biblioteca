CREATE TABLE livro ( id int(10) NOT NULL, autores varchar(200) NOT NULL, titulo varchar(60) NOT NULL, ano char(4) NOT NULL, editora varchar(200) NOT NULL, quantidade int(10) NOT NULL, PRIMARY KEY ( id ) ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLEusuario ( nome varchar(200) NOT NULL, senha varchar(200) NOT NULL, email varchar(200) NOT NULL, PRIMARY KEY ( email ) ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE biblioteca.emprestimo ( emailUsuario VARCHAR(200) NOT NULL , idLivro INT(10) NOT NULL, PRIMARY KEY (emailUsuario, idLivro), CONSTRAINT fk_usuario FOREIGN KEY (emailUsuario) REFERENCES usuario(email), CONSTRAINT fk_livro FOREIGN KEY (idLivro) REFERENCES livro(id) ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;