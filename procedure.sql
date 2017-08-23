/*    ==Parâmetros de Script==

    Versão do Servidor de Origem : SQL Server 2016 (13.0.4206)
    Edição do Mecanismo de Banco de Dados de Origem : Microsoft SQL Server Express Edition
    Tipo do Mecanismo de Banco de Dados de Origem : SQL Server Autônomo

    Versão do Servidor de Destino : SQL Server 2017
    Edição de Mecanismo de Banco de Dados de Destino : Microsoft SQL Server Standard Edition
    Tipo de Mecanismo de Banco de Dados de Destino : SQL Server Autônomo
*/

USE [dbphp7]
GO
/****** Object:  StoredProcedure [dbo].[sp_usuarios_insert]    Script Date: 23/08/2017 15:03:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
ALTER
PROCEDURE [dbo].[sp_usuarios_insert]

@pdeslogin nvarchar(50),
@pdessenha nvarchar(50)

AS
BEGIN


INSERT INTO tb_usuarios (deslogin, dessenha) VALUES (@pdeslogin, @pdessenha);

SELECT * from tb_usuarios WHERE id = @@Identity;


END