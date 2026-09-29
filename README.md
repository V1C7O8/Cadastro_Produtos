# Cadastro de Produtos em PHP + MySQL

Este repositório contém a resolução do desafio prático do módulo de PHP e Banco de Dados. O objetivo principal é disponibilizar um formulário web para registar produtos na base de dados `exercicio`, aplicando validações no servidor.

---

## 🚀 Funcionalidades

- **Formulário Web:** Campos para entrada do **Nome do Produto** e **Preço**.
- **Validação Server-Side (PHP):**
  - Verifica se o nome do produto não está vazio.
  - Garante que o preço é um valor numérico positivo estritamente maior que zero.
- **Tratamento de Decimais:** Converte automaticamente vírgulas em pontos para o formato padrão do MySQL.
- **Integração com Banco de Dados:** Utiliza **PDO (PHP Data Objects)** com *Prepared Statements* para evitar vulnerabilidades do tipo SQL Injection.
- **Feedback ao Utilizador:** Exibe mensagens claras de sucesso ou erro diretamente no ecrã.

---

## 🛠️ Tecnologias Utilizadas

* PHP
* MySQL
* HTML
* Visual Studio Code

---

## 🗄️ Estrutura da Base de Dados

Antes de executar a aplicação, certifique-se de que a base de dados `exercicio` e a tabela `produtos` foram criadas no seu ambiente MySQL local:

```sql
CREATE DATABASE IF NOT EXISTS exercicio;
USE exercicio;

CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    preco DECIMAL(10,2) NOT NULL
);
