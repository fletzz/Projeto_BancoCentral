# BancoCentral - Sistema de Transferências Bancárias

Um sistema bancário distribuído desenvolvido em PHP e MySQL que simula operações bancárias entre diferentes instituições. O projeto implementa um sistema de transferências entre bancos, com uma central de processamento que gerencia e valida as transações.

## 🚀 Funcionalidades

- Sistema distribuído com múltiplos bancos
- Central de processamento de transferências
- Logs de debug para rastreamento de operações
- Estrutura modular com bancos independentes
- APIs para transferências e recebimento de créditos

## 🛠️ Tecnologias Utilizadas

- **Backend:** PHP
- **Banco de Dados:** MySQL
- **Servidor:** Node.js
- **Túnel Local:** LocalTunnel
- **Frontend:** HTML/CSS

## 📁 Estrutura do Projeto

```
bancocao/
├── aluno1/              # Banco 1
│   └── transferir.php   # API de transferência
├── aluno2/              # Banco 2
│   └── receber_credito.php  # API de recebimento
├── central/             # Central de Processamento
│   ├── debug_envio_aluno2.txt
│   ├── debug_post.txt
│   └── processa_transferencia.php
└── sql/                 # Scripts SQL
    ├── banco_aluno1.sql
    ├── banco_aluno2.sql
    └── banco_central.sql
```

## 🚦 Status do Projeto

O projeto está em desenvolvimento ativo e passando por testes iniciais. Atualizações são feitas regularmente.

## 👥 Colaboradores

- Rangel Duarte (@rangelduarte)

## 🔧 Como Executar

1. Clone o repositório
2. Configure seu servidor PHP e MySQL
3. Execute os scripts SQL da pasta `sql/`
4. Configure as variáveis de ambiente necessárias
5. Inicie o servidor Node.js para o túnel local

## 📝 Licença

Este projeto está sob licença MIT. Consulte o arquivo LICENSE para mais detalhes.

