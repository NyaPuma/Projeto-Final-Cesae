# Arquitetura de Dados - DER

Este diagrama apresenta a modelação da base de dados relacional para o Sistema de Gestão de Manutenção.

![Diagrama Entidade-Relacionamento](../docs/Diagrama_Base_Dados.drawio.svg)

## Notas Técnicas
* **Abordagem:** Modelo Relacional (MySQL).
* **Integridade:** Foram aplicadas chaves estrangeiras (`Foreign Keys`) com restrições de integridade referencial (`ON DELETE RESTRICT`) para prevenir a eliminação acidental de dados associados.
* **Telemetria:** O modelo foca-se na persistência de avarias e no histórico de manutenção, tratando a telemetria como um fluxo de exceções (Gestão por Exceção).

