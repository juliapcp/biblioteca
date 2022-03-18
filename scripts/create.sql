CREATE TABLE livro ( id int(10) NOT NULL AUTO_INCREMENT, autores varchar(200) NOT NULL, titulo varchar(60) NOT NULL, ano char(4) NOT NULL, editora varchar(200) NOT NULL, quantidade int(10) NOT NULL, PRIMARY KEY ( id ) ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE usuario ( nome varchar(200) NOT NULL, senha varchar(200) NOT NULL, email varchar(200) NOT NULL, PRIMARY KEY ( email ) ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE emprestimo ( emailUsuario VARCHAR(200) NOT NULL , idLivro INT(10) NOT NULL, PRIMARY KEY (emailUsuario, idLivro), CONSTRAINT fk_usuario FOREIGN KEY (emailUsuario) REFERENCES usuario(email), CONSTRAINT fk_livro FOREIGN KEY (idLivro) REFERENCES livro(id) ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `livro` (`id`, `autores`, `titulo`, `ano`, `editora`, `quantidade`) VALUES
(0, 'Harper Lee', 'O sol é para todos', '2006', 'José Olympio', 15),
(1, 'Jane Austen', 'Orgulho e preconceito', '2002', 'Alura', 10),
(2, 'George Orwell', '1984', '1949', 'Alura', 10),
(3, 'George Orwell', 'Revolução dos bichos', '2007', 'Companhia das Letras', 10),
(4, 'Jorge Amado', 'Capitães de Areia', '2009', 'Companhia de Bolso', 19),
(5, 'Martha Medeiros', 'Feliz por nada', '2011', 'L&PM', 19),
(6, 'Martha Medeiros', 'A graça da coisa', '2013', 'L&PM', 16);
