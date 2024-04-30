<?php

namespace Php\Projeto2\Factory;

use Faker\Factory;
use PDOException;
use Php\Projeto2\Model\DAO\CategoriaDao;
use Php\Projeto2\Model\DAO\CertificacaoDao;
use Php\Projeto2\Model\DAO\Conexao;
use Php\Projeto2\Model\DAO\ProdutoDao;
use Php\Projeto2\Model\DAO\RefreshDatabase;
use Php\Projeto2\Model\DAO\UsuarioDao;
use Php\Projeto2\Model\Domain\Categoria;
use Php\Projeto2\Model\Domain\Certificacao;
use Php\Projeto2\Model\Domain\Produto;
use Php\Projeto2\Model\Domain\Usuario;

class PopulateCascadeSeedFactory
{
    protected $faker;
    protected RefreshDatabase $refreshDatabase;
    protected CertificacaoDao $certificacaoDao;
    protected CategoriaDao $categoriaDao;
    protected ProdutoDao $produtoDao;
    protected UsuarioDao $usuarioDao;

    protected $pdo;

    public function __construct(
        RefreshDatabase $refreshDatabase,
        CertificacaoDao $certificacaoDao,
        CategoriaDao    $categoriaDao,
        ProdutoDao      $produtoDao,
        UsuarioDao      $usuarioDao
    )
    {
        $this->refreshDatabase = $refreshDatabase;
        $this->certificacaoDao = $certificacaoDao;
        $this->categoriaDao = $categoriaDao;
        $this->produtoDao = $produtoDao;
        $this->usuarioDao = $usuarioDao;

        $this->faker = Factory::create('pt_BR');

        $conn = new Conexao();
        $this->pdo = $conn->getConexao();

    }
    public function rollBackDatabase()
    {
        try {

            $this->refreshDatabase->refreshDatabase();

            return [
                'success' => true,
                'message' => 'Rollback de tabelas finalizado!'
            ];
        } catch (PDOException $e) {

            return throw new PDOException($e->getMessage());
        }
    }
    public function seedWithRollBack()
    {
        try {
            $this->pdo->beginTransaction();

            $this->refreshDatabase->refreshDatabase();

            $this->generateCategoria();
            $this->generateProduto(50);
            $this->generateUsuario(50);
            $this->generateCertificado(2);

            $this->pdo->commit();
            return [
                'success' => true,
                'message' => 'Banco populado com sucesso!'
            ];
        } catch (PDOException $e) {

            $this->pdo->rollBack();
            return throw new PDOException($e->getMessage());
        }
    }

    private function generateCertificado(int $qtdPorUsuario): PDOException|bool
    {
        try {
            $usuarioDao = new UsuarioDao();
            $certificacoesDao = new CertificacaoDao();

            $arrayEmpresas = [
                'Alura',
                'DIO',
                'Udemy'
            ];

            $daoResponse = $usuarioDao->getALl();
            $usuarios = $daoResponse['model'];

            $arrayFormacoes = $this->arrayFormacoes();

            foreach ($usuarios as $usuario) {
                for ($i = 1; $i <= $qtdPorUsuario; $i++) {
                    $certificado = new Certificacao(
                        $this->faker->randomElement($arrayFormacoes),
                        $this->faker->numberBetween(5, 150) . 'Hrs de curso.',
                        $this->faker->randomElement($arrayEmpresas),
                        $usuario['id']
                    );

                    $certificacoesDaoResponse = $certificacoesDao->create($certificado);

                    if (!$certificacoesDaoResponse['success']) {
                        throw new PDOException($daoResponse['message']);
                    }
                }
            }
            return true;
        } catch (PdoException $e) {
            return throw new PDOException($e->getMessage());
        }
    }

    private function generateUsuario(int $qtdUsuarios): PDOException|bool
    {
        try {
            for ($i = 1; $i <= $qtdUsuarios; $i++) {
                $usuario = new Usuario(
                    $this->faker->unique()->firstName,
                    $this->faker->numberBetween(11111111111, 99999999999)
                );
                $usuarioDao = new UsuarioDao();
                $daoResponse = $usuarioDao->create($usuario);
                if (!$daoResponse['success']) {
                    throw new PDOException($daoResponse['message']);
                }
            }
            return true;
        } catch (PdoException $e) {
            return throw new PDOException($e->getMessage());
        }
    }

    private function generateCategoria(): PDOException|bool
    {
        try {
            $categorias = $this->arrayCategorias();

            foreach ($categorias as $categoria) {

                $minhaCategoria = new Categoria($categoria);
                $categoriaDao = new CategoriaDAO();

                $daoResponse = $categoriaDao->create($minhaCategoria);
                if (!$daoResponse['success']) {
                    throw new PDOException($daoResponse['message']);
                }
            }
            return true;

        } catch (PdoException $e) {
            return throw new PDOException($e->getMessage());
        }
    }

    private function generateProduto(int $qtdProdutos): PDOException|bool
    {
        try {
            $categoriaDato = new CategoriaDao();
            $daoResponse = $categoriaDato->getALl();
            if (!$daoResponse['success']) {
                return false;
            }

            for ($i = 1; $i <= $qtdProdutos; $i++) {
                $produto = new Produto(
                    $this->faker->firstName,
                    $this->faker->numberBetween(1, 30),
                    $this->faker->numberBetween(1, 40),
                );
                $produtoDao = new ProdutoDAO();
                $daoProdutoResponse = $produtoDao->create($produto);

                if (!$daoProdutoResponse['success']) {
                    throw new PDOException($daoResponse['message']);
                }
            }
            return true;
        } catch (PdoException $e) {
            return throw new PDOException($e->getMessage());
        }
    }

    private function arrayCategorias(): array
    {
        $categorias = [
            'Frutas frescas',
            'Vegetais frescos',
            'Carnes frescas (bovina, suína, aves, etc.)',
            'Peixes e frutos do mar frescos',
            'Produtos lácteos (leite, queijo, iogurte, manteiga)',
            'Ovos',
            'Pães e produtos de padaria',
            'Cereais e grãos (arroz, trigo, aveia, quinoa)',
            'Massas e noodles',
            'Molhos e condimentos',
            'Enlatados (feijão, milho, atum, sardinha)',
            'Azeites e óleos de cozinha',
            'Temperos e especiarias',
            'Snacks e petiscos',
            'Doces e chocolates',
            'Bebidas alcoólicas (vinhos, cervejas, destilados)',
            'Bebidas não alcoólicas (refrigerantes, sucos, água)',
            'Café e chá',
            'Produtos de higiene pessoal (sabonetes, xampus, pasta de dentes)',
            'Produtos de cuidados com a pele',
            'Produtos de cuidados com o cabelo',
            'Cosméticos (maquiagem, batons, bases)',
            'Produtos de higiene íntima',
            'Fraldas e produtos para bebês',
            'Produtos de limpeza doméstica (detergentes, desinfetantes, limpadores multiuso)',
            'Utensílios de cozinha',
            'Artigos de papelaria (papel, canetas, cadernos)',
            'Eletrônicos (pilhas, cabos, adaptadores)',
            'Ferramentas e equipamentos de manutenção doméstica',
            'Produtos para jardinagem',
            'Ração para animais de estimação',
            'Produtos para animais de estimação (coleiras, brinquedos, camas)',
            'Artigos esportivos (bolas, equipamentos de ginástica)',
            'Material de camping (barracas, sacos de dormir)',
            'Roupas íntimas e meias',
            'Roupas esportivas',
            'Calçados',
            'Acessórios de moda (bolsas, cintos, bijuterias)',
            'Produtos de limpeza automotiva',
            'Acessórios para carros (tapetes, capas de assento, aromatizantes)',
        ];

        return $categorias;
    }

    private function arrayFormacoes(): array
    {
        $arrayFormacoes = [
            'Desenvolvedor Web Front-end',
            'Desenvolvedor Web Back-end',
            'Desenvolvedor Full Stack',
            'Engenheiro de Software',
            'Engenheiro de Dados',
            'Arquiteto de Software',
            'Desenvolvedor de Aplicativos Móveis (iOS/Android)',
            'Desenvolvedor de Jogos',
            'Desenvolvedor de Realidade Virtual (VR)',
            'Desenvolvedor de Realidade Aumentada (AR)',
            'Designer de Interface do Usuário (UI Designer)',
            'Designer de Experiência do Usuário (UX Designer)',
            'Analista de Sistemas',
            'Analista de Dados',
            'Cientista de Dados',
            'Engenheiro de Machine Learning',
            'Engenheiro de Inteligência Artificial',
            'Engenheiro de Segurança da Informação',
            'Administrador de Banco de Dados (DBA)',
            'Administrador de Redes',
            'Engenheiro de DevOps',
            'Especialista em Cloud Computing',
            'Engenheiro de Sistemas Embarcados',
            'Engenheiro de Automação Industrial',
            'Engenheiro de Software Embarcado',
            'Desenvolvedor de Sistemas Embarcados',
            'Especialista em Internet das Coisas (IoT)',
            'Engenheiro de Redes Sem Fio',
            'Engenheiro de Telecomunicações',
            'Especialista em Cibersegurança',
            'Engenheiro de Testes de Software',
            'Engenheiro de Qualidade de Software',
            'Desenvolvedor de Blockchain',
            'Especialista em Big Data',
            'Engenheiro de Robótica',
            'Desenvolvedor de Sistemas Distribuídos',
            'Desenvolvedor de Sistemas de Informação Geográfica (GIS)',
            'Engenheiro de Automação Residencial',
            'Engenheiro de Automação de Processos',
            'Analista de Business Intelligence (BI)',
            'Engenheiro de Sistemas de Controle',
            'Engenheiro de Sistemas Operacionais',
            'Desenvolvedor de Aplicações Desktop',
            'Especialista em Realidade Artificial (AI)',
            'Especialista em UX Research',
            'Especialista em Computação Gráfica',
            'Especialista em Linguagem Natural',
            'Especialista em Reconhecimento de Padrões',
            'Especialista em Visualização de Dados',
            'Especialista em Arquitetura de Software',
        ];
        return $arrayFormacoes;
    }
}
