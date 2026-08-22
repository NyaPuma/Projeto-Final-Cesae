<?php

declare(strict_types=1);

namespace Database\Seeders\Data;

/**
 * Dados de domínio reutilizáveis pelos seeders operacionais.
 *
 * Toda a informação é ficcional, mas mantém o registo e o vocabulário
 * técnico do domínio de manutenção industrial em português europeu.
 * Não contém lorem ipsum nem valores aleatórios sem significado.
 */
final class OperationalData
{
    /**
     * Salas reais do parque (edifício e piso).
     *
     * @return array<int, array{name: string, building: string, floor: string}>
     */
    public static function rooms(): array
    {
        return [
            ['name' => 'Linha de Montagem A', 'building' => 'Pavilhão Industrial 1', 'floor' => 'Piso 0'],
            ['name' => 'Linha de Montagem B', 'building' => 'Pavilhão Industrial 1', 'floor' => 'Piso 0'],
            ['name' => 'Laboratório de I&D', 'building' => 'Edifício Central', 'floor' => 'Piso 2'],
            ['name' => 'Armazém Logístico', 'building' => 'Pavilhão Sul', 'floor' => 'Piso 0'],
            ['name' => 'Zona de Soldadura', 'building' => 'Pavilhão Industrial 2', 'floor' => 'Piso 0'],
            ['name' => 'Sala de Servidores', 'building' => 'Edifício Central', 'floor' => 'Piso 1'],
            ['name' => 'Oficina Mecânica', 'building' => 'Pavilhão Industrial 2', 'floor' => 'Piso 0'],
            ['name' => 'Câmara Fria de Armazenamento', 'building' => 'Pavilhão Norte', 'floor' => 'Piso 0'],
            ['name' => 'Linha de Embalagem', 'building' => 'Pavilhão Industrial 1', 'floor' => 'Piso 1'],
            ['name' => 'Estação de Carga de Baterias', 'building' => 'Pavilhão Norte', 'floor' => 'Piso 0'],
            ['name' => 'Sala de Quadros Elétricos', 'building' => 'Pavilhão Industrial 1', 'floor' => 'Piso 0'],
            ['name' => 'Sala de Comando Central', 'building' => 'Edifício Central', 'floor' => 'Piso 1'],
            ['name' => 'Cais de Carga e Descarga', 'building' => 'Pavilhão Sul', 'floor' => 'Piso 0'],
            ['name' => 'Zona de Controlo de Qualidade', 'building' => 'Edifício Central', 'floor' => 'Piso 0'],
            ['name' => 'Sala de Testes Funcionais', 'building' => 'Edifício Central', 'floor' => 'Piso 0'],
            ['name' => 'Zona de Estampagem', 'building' => 'Pavilhão Industrial 2', 'floor' => 'Piso 0'],
            ['name' => 'Armazém de Peças de Reserva', 'building' => 'Pavilhão Norte', 'floor' => 'Piso 1'],
            ['name' => 'Sala do Compressor Central', 'building' => 'Pavilhão Industrial 2', 'floor' => 'Piso 0'],
            ['name' => 'Posto de Triagem de Resíduos', 'building' => 'Pavilhão Norte', 'floor' => 'Piso 0'],
            ['name' => 'Linha de Pintura Industrial', 'building' => 'Pavilhão Industrial 2', 'floor' => 'Piso 1'],
            ['name' => 'Zona de Injeção de Plásticos', 'building' => 'Pavilhão Industrial 2', 'floor' => 'Piso 0'],
            ['name' => 'Sala de UPS e Energia', 'building' => 'Edifício Central', 'floor' => 'Piso -1'],
            ['name' => 'Vestiários Operacionais', 'building' => 'Pavilhão Industrial 1', 'floor' => 'Piso 0'],
            ['name' => 'Refeitório', 'building' => 'Edifício Central', 'floor' => 'Piso 0'],
            ['name' => 'Recepção e Escritórios', 'building' => 'Edifício Central', 'floor' => 'Piso 0'],
            ['name' => 'Gabinete de Manutenção', 'building' => 'Pavilhão Industrial 1', 'floor' => 'Piso 1'],
            ['name' => 'Sala de Reuniões Técnicas', 'building' => 'Edifício Central', 'floor' => 'Piso 2'],
            ['name' => 'Posto de Segurança Periférica', 'building' => 'Edifício Central', 'floor' => 'Piso 0'],
            ['name' => 'Armazém de Matérias-Primas', 'building' => 'Pavilhão Norte', 'floor' => 'Piso 0'],
            ['name' => 'Zona de Montagem Final', 'building' => 'Pavilhão Industrial 1', 'floor' => 'Piso 0'],
            ['name' => 'Sala de Pintura a Pó', 'building' => 'Pavilhão Industrial 2', 'floor' => 'Piso 1'],
            ['name' => 'Centro de Torneagem CNC', 'building' => 'Pavilhão Industrial 2', 'floor' => 'Piso 0'],
            ['name' => 'Centro de Fresagem CNC', 'building' => 'Pavilhão Industrial 2', 'floor' => 'Piso 0'],
            ['name' => 'Laboratório de Calibração', 'building' => 'Edifício Central', 'floor' => 'Piso 2'],
            ['name' => 'Sala de Comunicações', 'building' => 'Edifício Central', 'floor' => 'Piso 1'],
            ['name' => 'Central de Ar Comprimido', 'building' => 'Pavilhão Industrial 2', 'floor' => 'Piso 0'],
            ['name' => 'Zona de Expedições', 'building' => 'Pavilhão Sul', 'floor' => 'Piso 0'],
            ['name' => 'Armazém de Embalagens', 'building' => 'Pavilhão Norte', 'floor' => 'Piso 0'],
            ['name' => 'Linha de Enchimento Automático', 'building' => 'Pavilhão Industrial 1', 'floor' => 'Piso 1'],
            ['name' => 'Sala de Aspiração Industrial', 'building' => 'Pavilhão Industrial 2', 'floor' => 'Piso 0'],
        ];
    }

    /**
     * Catálogo de equipamentos com peso de avaria (Pareto).
     *
     * @return array<int, array{name: string, brand: string, model: string, category: string, weight: int, serial: string, description: string}>
     */
    public static function equipmentCatalog(): array
    {
        return [
            // Robotics (high weights — critical line)
            ['name' => 'Braço Robótico KUKA KR210', 'brand' => 'KUKA', 'model' => 'KR210 R2700', 'category' => 'Robótica', 'weight' => 95, 'serial' => 'KUKA-KR210-2026', 'description' => 'Braço articulado principal da célula de soldadura da Linha de Montagem A.'],
            ['name' => 'Braço Robótico FANUC M-20iA', 'brand' => 'FANUC', 'model' => 'M-20iA/35M', 'category' => 'Robótica', 'weight' => 88, 'serial' => 'FANUC-M20IA-018', 'description' => 'Robô de manipulação de peças na célula de montagem B.'],
            ['name' => 'Robô de Paletização ABB IRB 460', 'brand' => 'ABB', 'model' => 'IRB 460', 'category' => 'Robótica', 'weight' => 60, 'serial' => 'ABB-IRB460-004', 'description' => 'Robô de paletização das linhas de embalagem automática.'],
            ['name' => 'Célula Robotizada de Soldadura', 'brand' => 'Fronius', 'model' => 'TS 7000', 'category' => 'Robótica', 'weight' => 82, 'serial' => 'FRN-TS7000-011', 'description' => 'Célula de soldadura por pontos com controlo de qualidade integrado.'],
            ['name' => 'Unidade de Controlo Robótica KRC4', 'brand' => 'KUKA', 'model' => 'KRC4', 'category' => 'Robótica', 'weight' => 55, 'serial' => 'KUKA-KRC4-002', 'description' => 'Controlador principal do braço robótico da linha de montagem.'],
            ['name' => 'Periférico de Segurança Robótica SICK', 'brand' => 'SICK', 'model' => 'microScan3', 'category' => 'Robótica', 'weight' => 45, 'serial' => 'SICK-MS3-007', 'description' => 'Scanner de segurança do perímetro da célula robotizada.'],

            // Automation (medium-high weights)
            ['name' => 'Prensa Hidráulica 50T', 'brand' => 'Mitsubishi', 'model' => 'PH-50T', 'category' => 'Automação', 'weight' => 90, 'serial' => 'PRES-HYD-50T-99', 'description' => 'Prensa hidráulica de estampagem de componentes metálicos.'],
            ['name' => 'Prensa Mecânica de Estampagem', 'brand' => 'Bruderer', 'model' => 'BSTA 200', 'category' => 'Automação', 'weight' => 78, 'serial' => 'BRD-BSTA200-03', 'description' => 'Prensa mecânica de alta velocidade da zona de estampagem.'],
            ['name' => 'Tapete Transportador de Corrente', 'brand' => 'Bosch Rexroth', 'model' => 'TS 4plus', 'category' => 'Automação', 'weight' => 72, 'serial' => 'RXT-TS4P-021', 'description' => 'Transportador de corrente da linha de montagem principal.'],
            ['name' => 'Painel de Automação Siemens S7-1500', 'brand' => 'Siemens', 'model' => 'S7-1500', 'category' => 'Automação', 'weight' => 68, 'serial' => 'SIE-S71500-008', 'description' => 'PLC central de controlo da linha de enchimento.'],
            ['name' => 'Soldador por Ponto', 'brand' => 'Fronius', 'model' => 'TPS 400i', 'category' => 'Automação', 'weight' => 50, 'serial' => 'FRN-TPS400-014', 'description' => 'Equipamento de soldadura por ponto da célula de montagem.'],
            ['name' => 'Estação de Enchimento Automática', 'brand' => 'Krones', 'model' => 'Contiform', 'category' => 'Automação', 'weight' => 85, 'serial' => 'KRN-CONT-005', 'description' => 'Estação de enchimento de alta cadência da linha 1.'],
            ['name' => 'Célula de Embalagem por Paletização', 'brand' => 'Schneider', 'model' => 'EcoStruxure', 'category' => 'Automação', 'weight' => 58, 'serial' => 'SCH-ECO-016', 'description' => 'Célula de embalagem e paletização automática.'],
            ['name' => 'Bomba de Dosagem de Fluidos', 'brand' => 'Grundfos', 'model' => 'CRNE', 'category' => 'Automação', 'weight' => 52, 'serial' => 'GRF-CRNE-009', 'description' => 'Bomba de dosagem de lubrificante do sistema central.'],

            // Infrastructure (medium weights)
            ['name' => 'Servidor Central Dell PowerEdge', 'brand' => 'Dell', 'model' => 'PowerEdge R750', 'category' => 'Infraestruturas', 'weight' => 80, 'serial' => 'DELL-PE-R750-SRV', 'description' => 'Servidor central de aplicações e base de dados.'],
            ['name' => 'UPS Industrial Eaton 93PM', 'brand' => 'Eaton', 'model' => '93PM', 'category' => 'Infraestruturas', 'weight' => 65, 'serial' => 'EAT-93PM-013', 'description' => 'UPS trifásica do edifício central.'],
            ['name' => 'Quadro Elétrico Principal', 'brand' => 'Schneider', 'model' => 'Prisma', 'category' => 'Infraestruturas', 'weight' => 60, 'serial' => 'SCH-PRSM-001', 'description' => 'Quadro elétrico de distribuição principal do pavilhão 1.'],
            ['name' => 'Compressor de Ar Central', 'brand' => 'Atlas Copco', 'model' => 'GA 75', 'category' => 'Infraestruturas', 'weight' => 70, 'serial' => 'ATC-GA75-006', 'description' => 'Compressor de ar comprimido do anel industrial.'],
            ['name' => 'Sistema de Climatização Industrial', 'brand' => 'Carrier', 'model' => 'AquaForce', 'category' => 'Infraestruturas', 'weight' => 55, 'serial' => 'CAR-AQF-019', 'description' => 'Sistema de climatização das salas de servidores.'],
            ['name' => 'Gerador de Emergência', 'brand' => 'Caterpillar', 'model' => 'C15', 'category' => 'Infraestruturas', 'weight' => 42, 'serial' => 'CAT-C15-010', 'description' => 'Grupo gerador de emergência do edifício central.'],
            ['name' => 'Switch Core Cisco Catalyst', 'brand' => 'Cisco', 'model' => 'Catalyst 9500', 'category' => 'Infraestruturas', 'weight' => 35, 'serial' => 'CSC-C9500-012', 'description' => 'Comutador de núcleo da rede industrial.'],
            ['name' => 'Central de Aspiração Industrial', 'brand' => 'Camfil', 'model' => 'Gold Series', 'category' => 'Infraestruturas', 'weight' => 38, 'serial' => 'CMF-GS-017', 'description' => 'Sistema de aspiração de poeiras da zona de pintura.'],

            // Logistics (varied weights)
            ['name' => 'Empilhador Elétrico Toyota', 'brand' => 'Toyota', 'model' => '8FBE', 'category' => 'Logística', 'weight' => 75, 'serial' => 'TOY-ELEC-404', 'description' => 'Empilhador elétrico de contrapeso do armazém logístico.'],
            ['name' => 'Empilhador Gás STILL', 'brand' => 'STILL', 'model' => 'RX70', 'category' => 'Logística', 'weight' => 58, 'serial' => 'STL-RX70-020', 'description' => 'Empilhador a GPL para operações de cais.'],
            ['name' => 'Porta-Paletes Elétrico', 'brand' => 'Jungheinrich', 'model' => 'EJE 120', 'category' => 'Logística', 'weight' => 40, 'serial' => 'JNG-EJE120-015', 'description' => 'Porta-paletes elétrico de preparação de expedições.'],
            ['name' => 'Sistema de Transporte por Correia', 'brand' => 'Vanderlande', 'model' => 'CBX', 'category' => 'Logística', 'weight' => 66, 'serial' => 'VDL-CBX-022', 'description' => 'Transportador de correia do armazém automático.'],
            ['name' => 'Cinta de Pesagem Dinâmica', 'brand' => 'Mettler Toledo', 'model' => 'C31', 'category' => 'Logística', 'weight' => 44, 'serial' => 'MTL-C31-024', 'description' => 'Balança dinâmica de verificação de peso em linha.'],
            ['name' => 'Scanner de Códigos Datalogic', 'brand' => 'Datalogic', 'model' => 'Matrix 120', 'category' => 'Logística', 'weight' => 32, 'serial' => 'DTL-M120-025', 'description' => 'Leitor de códigos de barras do posto de triagem.'],
        ];
    }

    /**
     * Cenários de avaria por categoria de equipamento.
     *
     * @return array<string, array<int, array{title: string, description: string, minutes: int}>>
     */
    public static function ticketScenariosByCategory(): array
    {
        return [
            'Robótica' => [
                ['title' => 'Erro de comunicação no controlador', 'description' => 'O controlador perde comunicação com o braço e interrompe o ciclo de produção. O alarme E-2038 aparece intermitentemente.', 'minutes' => 180],
                ['title' => 'Desvio de posição no fim do eixo', 'description' => 'O robô atinge a posição pretendida com um desvio de vários milímetros, afetando a precisão da soldadura.', 'minutes' => 240],
                ['title' => 'Alarme de colisão detetado', 'description' => 'O robô parou com alarme de colisão no eixo 3, sem causa aparente na programação.', 'minutes' => 150],
                ['title' => 'Falha na célula de segurança', 'description' => 'O scanner de segurança não reconhece a abertura de zona, bloqueando o arranque da célula.', 'minutes' => 120],
                ['title' => 'Lubrificação insuficiente do eixo', 'description' => 'A central de lubrificação do eixo 2 não atinge a pressão nominal durante o ciclo.', 'minutes' => 90],
                ['title' => 'Erro de encoders no eixo rotativo', 'description' => 'O encoder do eixo rotativo reporta valores incoerentes e a célula entra em modo de emergência.', 'minutes' => 300],
                ['title' => 'Fuga de óleo na base do braço', 'description' => 'Existe fuga de óleo na junta da base que acumula resíduo no chão da célula.', 'minutes' => 200],
                ['title' => 'Tempo de ciclo acima do especificado', 'description' => 'O robô executa o ciclo com atraso superior a 10% do tempo especificado.', 'minutes' => 160],
            ],
            'Automação' => [
                ['title' => 'Fuga de óleo no pistão hidráulico', 'description' => 'Gotejamento constante na base do pistão após operação prolongada a alta pressão.', 'minutes' => 260],
                ['title' => 'Lentidão no arranque do ciclo', 'description' => 'A prensa demora mais tempo do que o normal a atingir a pressão de trabalho.', 'minutes' => 130],
                ['title' => 'Erro de pressão no acumulador', 'description' => 'O acumulador hidráulico não mantém a pressão durante a pausa de ciclo.', 'minutes' => 180],
                ['title' => 'Vibração anormal no transportador', 'description' => 'O tapete transportador apresenta vibração e ruído na zona de retorno da corrente.', 'minutes' => 100],
                ['title' => 'Paragem do PLC sem motivo', 'description' => 'O painel de automação reinicia sem indicação de erro e perde o estado da linha.', 'minutes' => 220],
                ['title' => 'Sensores de fim de curso desalinhados', 'description' => 'Os sensores de posição da estação de enchimento não detetam as garrafas na sequência correta.', 'minutes' => 110],
                ['title' => 'Desgaste das guias lineares', 'description' => 'As guias da mesa deslizante apresentam folga e marcas de desgaste visíveis.', 'minutes' => 320],
                ['title' => 'Erro na dosagem de fluido', 'description' => 'A bomba de dosagem entrega uma quantidade inferior ao definido na receita.', 'minutes' => 140],
            ],
            'Infraestruturas' => [
                ['title' => 'Sobreaquecimento do nó primário', 'description' => 'Os discos apresentam latência elevada e as ventoinhas operam em rotação máxima contínua.', 'minutes' => 240],
                ['title' => 'Queda de tensão no quadro principal', 'description' => 'O quadro regista flutuações de tensão que afetam as linhas a jusante.', 'minutes' => 210],
                ['title' => 'Alarme de carga na UPS', 'description' => 'A UPS reporta falha de uma bateria do conjunto e passa a funcionar em bypass.', 'minutes' => 300],
                ['title' => 'Pressão baixa no anel de ar comprimido', 'description' => 'O compressor alterna em carga sem atingir a pressão nominal do anel.', 'minutes' => 170],
                ['title' => 'Fuga de refrigerante na climatização', 'description' => 'A sala de servidores não atinge a temperatura alvo e o circuito reporta pressão baixa.', 'minutes' => 280],
                ['title' => 'Falha de ligação na rede industrial', 'description' => 'Intermitência de ligação entre o switch core e a zona de produção.', 'minutes' => 90],
                ['title' => 'Gerador não arranca em teste', 'description' => 'O gerador de emergência falha o arranque no teste mensal por carga de bateria.', 'minutes' => 160],
                ['title' => 'Poços de aspiração sem caudal', 'description' => 'A central de aspiração não gera o caudal previsto nas condutas da zona de pintura.', 'minutes' => 130],
            ],
            'Logística' => [
                ['title' => 'Bateria do empilhador não carrega', 'description' => 'O carregador reporta falha e a bateria não atinge o estado de carga completo.', 'minutes' => 150],
                ['title' => 'Falha de direção assistida', 'description' => 'O empilhador apresenta resistência elevada na direção durante as manobras.', 'minutes' => 200],
                ['title' => 'Fuga de fluido hidráulico do mastro', 'description' => 'Fuga de fluido na base do mastro com perda de capacidade de elevação.', 'minutes' => 240],
                ['title' => 'Correia do transportador desliza', 'description' => 'A correia do transportador escorrega na polia motriz, parando o fluxo de caixas.', 'minutes' => 120],
                ['title' => 'Leitor de códigos com falhas', 'description' => 'O scanner não lê etiquetas danificadas e o posto de triagem acumula fila.', 'minutes' => 60],
                ['title' => 'Pesagem fora de tolerância', 'description' => 'A cinta de pesagem devolve valores fora do intervalo e rejeita artigos válidos.', 'minutes' => 140],
                ['title' => 'Porta de cais não abre', 'description' => 'O nivelador de cais falha o arranque elétrico durante as operações de carga.', 'minutes' => 110],
                ['title' => 'Rodado do empilhador gasto', 'description' => 'Os pneus do empilhador apresentam desgaste irregular e vibração em deslocação.', 'minutes' => 180],
            ],
        ];
    }

    /**
     * Catálogo de peças de reserva por categoria.
     *
     * @return array<string, array<int, array{name: string, brand: string, manufacturer_ref: string, cost_min: float, cost_max: float}>>
     */
    public static function partsByCategory(): array
    {
        return [
            'Rolamentos' => [
                ['name' => 'Rolamento de esferas 6205-2RS', 'brand' => 'SKF', 'manufacturer_ref' => '6205-2RS', 'cost_min' => 8, 'cost_max' => 18],
                ['name' => 'Rolamento rígido de esferas 6208', 'brand' => 'SKF', 'manufacturer_ref' => '6208', 'cost_min' => 12, 'cost_max' => 25],
                ['name' => 'Rolamento de rolos cónicos 30208', 'brand' => 'FAG', 'manufacturer_ref' => '30208', 'cost_min' => 15, 'cost_max' => 30],
                ['name' => 'Rolamento axial de esferas 51207', 'brand' => 'NSK', 'manufacturer_ref' => '51207', 'cost_min' => 10, 'cost_max' => 22],
                ['name' => 'Rolamento de agulhas RNA4904', 'brand' => 'INA', 'manufacturer_ref' => 'RNA4904', 'cost_min' => 9, 'cost_max' => 20],
                ['name' => 'Rolamento autocompensador 1208', 'brand' => 'NSK', 'manufacturer_ref' => '1208', 'cost_min' => 14, 'cost_max' => 28],
                ['name' => 'Chumaceira UCP205', 'brand' => 'NTN', 'manufacturer_ref' => 'UCP205', 'cost_min' => 18, 'cost_max' => 35],
                ['name' => 'Rolamento de contato angular 7306', 'brand' => 'FAG', 'manufacturer_ref' => '7306', 'cost_min' => 16, 'cost_max' => 32],
            ],
            'Correias e Polias' => [
                ['name' => 'Correia trapezoidal SPZ 1800', 'brand' => 'Optibelt', 'manufacturer_ref' => 'SPZ 1800', 'cost_min' => 12, 'cost_max' => 24],
                ['name' => 'Correia dentada HTD 8M 1200', 'brand' => 'Gates', 'manufacturer_ref' => 'HTD 8M', 'cost_min' => 25, 'cost_max' => 45],
                ['name' => 'Correia poly-V 6PK 1700', 'brand' => 'ContiTech', 'manufacturer_ref' => '6PK1700', 'cost_min' => 20, 'cost_max' => 38],
                ['name' => 'Polia cónica 30mm SPZ', 'brand' => 'Arntz', 'manufacturer_ref' => 'PZ-30', 'cost_min' => 28, 'cost_max' => 50],
                ['name' => 'Tensores automáticos de correia', 'brand' => 'Ina', 'manufacturer_ref' => 'TEN-300', 'cost_min' => 35, 'cost_max' => 60],
                ['name' => 'Correia plana de transporte 300mm', 'brand' => 'Habasit', 'manufacturer_ref' => 'PL-300', 'cost_min' => 40, 'cost_max' => 80],
                ['name' => 'Correia de distribuição de cárter', 'brand' => 'Gates', 'manufacturer_ref' => 'GAT-428', 'cost_min' => 22, 'cost_max' => 42],
                ['name' => 'Manga de ligação de correias', 'brand' => 'Optibelt', 'manufacturer_ref' => 'MG-90', 'cost_min' => 8, 'cost_max' => 16],
            ],
            'Componentes Elétricos' => [
                ['name' => 'Contator de potência 40A', 'brand' => 'Schneider', 'manufacturer_ref' => 'LC1D40', 'cost_min' => 45, 'cost_max' => 90],
                ['name' => 'Relé térmico de sobrecarga 16A', 'brand' => 'Schneider', 'manufacturer_ref' => 'LRD16', 'cost_min' => 18, 'cost_max' => 35],
                ['name' => 'Disjuntor motorizado 3P 25A', 'brand' => 'Eaton', 'manufacturer_ref' => 'PKZM0-25', 'cost_min' => 60, 'cost_max' => 110],
                ['name' => 'Fonte de alimentação 24VDC 10A', 'brand' => 'Mean Well', 'manufacturer_ref' => 'SDR-240', 'cost_min' => 55, 'cost_max' => 95],
                ['name' => 'Cartão de entrada digital 16 canais', 'brand' => 'Siemens', 'manufacturer_ref' => '6ES7321', 'cost_min' => 120, 'cost_max' => 220],
                ['name' => 'Relé de interface 24VDC', 'brand' => 'Phoenix', 'manufacturer_ref' => 'REL-MR-24', 'cost_min' => 12, 'cost_max' => 25],
                ['name' => 'Módulo de relé com 8 canais', 'brand' => 'Weidmüller', 'manufacturer_ref' => '8CH-REL', 'cost_min' => 40, 'cost_max' => 70],
                ['name' => 'Transformador de controlo 230/24V 100VA', 'brand' => 'Block', 'manufacturer_ref' => 'BST-100', 'cost_min' => 50, 'cost_max' => 85],
            ],
            'Componentes Hidráulicos' => [
                ['name' => 'Válvula direcional 4/3 com solenoide', 'brand' => 'Parker', 'manufacturer_ref' => 'D41VW', 'cost_min' => 90, 'cost_max' => 160],
                ['name' => 'Bomba hidráulica de engrenagens', 'brand' => 'Bosch Rexroth', 'manufacturer_ref' => 'AZP-16', 'cost_min' => 140, 'cost_max' => 260],
                ['name' => 'Filtro de óleo hidráulico', 'brand' => 'Pall', 'manufacturer_ref' => '30/25', 'cost_min' => 30, 'cost_max' => 55],
                ['name' => 'Acumulador de membrana 10L', 'brand' => 'Hydac', 'manufacturer_ref' => 'SB330', 'cost_min' => 200, 'cost_max' => 340],
                ['name' => 'Selo do cilindro hidráulico Ø50', 'brand' => 'Hallite', 'manufacturer_ref' => 'KIT-50', 'cost_min' => 25, 'cost_max' => 48],
                ['name' => 'Manómetro hidráulico 0-250 bar', 'brand' => 'Wika', 'manufacturer_ref' => '213.53', 'cost_min' => 35, 'cost_max' => 60],
                ['name' => 'Válvula limitadora de pressão', 'brand' => 'Rexroth', 'manufacturer_ref' => 'DBDH', 'cost_min' => 80, 'cost_max' => 140],
                ['name' => 'Mangueira hidráulica 3/4" com acoplamentos', 'brand' => 'Gates', 'manufacturer_ref' => 'HR-3/4', 'cost_min' => 42, 'cost_max' => 75],
            ],
            'Componentes Pneumáticos' => [
                ['name' => 'Cilindro pneumático Ø32 curso 100', 'brand' => 'Festo', 'manufacturer_ref' => 'ADN-32', 'cost_min' => 40, 'cost_max' => 75],
                ['name' => 'Válvula 5/2 monostável', 'brand' => 'SMC', 'manufacturer_ref' => 'SY5120', 'cost_min' => 55, 'cost_max' => 95],
                ['name' => 'Unidade de tratamento de ar FRL', 'brand' => 'Festo', 'manufacturer_ref' => 'MS6', 'cost_min' => 70, 'cost_max' => 120],
                ['name' => 'Eletroválvula proporcional', 'brand' => 'Parker', 'manufacturer_ref' => 'P2P', 'cost_min' => 160, 'cost_max' => 280],
                ['name' => 'Sensor de proximidade pneumático', 'brand' => 'SMC', 'manufacturer_ref' => 'D-A93', 'cost_min' => 15, 'cost_max' => 28],
                ['name' => 'Mangueira pneumática 8mm', 'brand' => 'Norgren', 'manufacturer_ref' => 'PU-8', 'cost_min' => 5, 'cost_max' => 12],
                ['name' => 'Regulador de pressão G1/4', 'brand' => 'Norgren', 'manufacturer_ref' => 'R43', 'cost_min' => 30, 'cost_max' => 55],
                ['name' => 'Escapamento silencioso G1/4', 'brand' => 'Festo', 'manufacturer_ref' => 'UC', 'cost_min' => 8, 'cost_max' => 15],
            ],
            'Fixadores' => [
                ['name' => 'Parafuso M8x30 com anilha', 'brand' => 'Bossard', 'manufacturer_ref' => 'M8-30', 'cost_min' => 0.2, 'cost_max' => 1],
                ['name' => 'Parafuso M10x40 de cabeça sextavada', 'brand' => 'Würth', 'manufacturer_ref' => 'M10-40', 'cost_min' => 0.3, 'cost_max' => 1.5],
                ['name' => 'Porca M8 autoblocante', 'brand' => 'Bossard', 'manufacturer_ref' => 'M8-NYL', 'cost_min' => 0.1, 'cost_max' => 0.8],
                ['name' => 'Anilha de pressão M10', 'brand' => 'Würth', 'manufacturer_ref' => 'AN-M10', 'cost_min' => 0.05, 'cost_max' => 0.4],
                ['name' => 'Kit de cavilhas de expansão', 'brand' => 'Fischer', 'manufacturer_ref' => 'SX-10', 'cost_min' => 5, 'cost_max' => 15],
                ['name' => 'Parafuso de bancada M12x50', 'brand' => 'Bossard', 'manufacturer_ref' => 'M12-50', 'cost_min' => 0.4, 'cost_max' => 2],
                ['name' => 'Gancho de segurança para suspensão', 'brand' => 'Crosby', 'manufacturer_ref' => 'S-259', 'cost_min' => 18, 'cost_max' => 40],
                ['name' => 'Corrente de transmissão 16B', 'brand' => 'Tsubaki', 'manufacturer_ref' => '16B-1', 'cost_min' => 35, 'cost_max' => 65],
            ],
            'Vedações' => [
                ['name' => 'Junta tórica NBR Ø30', 'brand' => 'Boyd', 'manufacturer_ref' => 'OR-30', 'cost_min' => 0.5, 'cost_max' => 2],
                ['name' => 'Junta tórica Viton Ø40', 'brand' => 'Parker', 'manufacturer_ref' => 'V75', 'cost_min' => 2, 'cost_max' => 6],
                ['name' => 'Gaxeta de vedação em PTFE', 'brand' => 'Garlock', 'manufacturer_ref' => 'PTFE-100', 'cost_min' => 8, 'cost_max' => 20],
                ['name' => 'Retentor de eixo 40x62x8', 'brand' => 'SKF', 'manufacturer_ref' => 'CR-40', 'cost_min' => 6, 'cost_max' => 15],
                ['name' => 'Junta de flange de máquina', 'brand' => 'Trelleborg', 'manufacturer_ref' => 'FL-200', 'cost_min' => 12, 'cost_max' => 25],
                ['name' => 'Guarnição de junta de cabeça', 'brand' => 'Reinz', 'manufacturer_ref' => 'GK-100', 'cost_min' => 20, 'cost_max' => 45],
                ['name' => 'Selo mecânico de bomba Ø25', 'brand' => 'John Crane', 'manufacturer_ref' => 'B-25', 'cost_min' => 60, 'cost_max' => 130],
                ['name' => 'Junta de silicone plano 200x150', 'brand' => 'Sika', 'manufacturer_ref' => 'JS-200', 'cost_min' => 4, 'cost_max' => 12],
            ],
            'Lubrificantes' => [
                ['name' => 'Óleo hidráulico ISO VG 46 (20L)', 'brand' => 'Mobil', 'manufacturer_ref' => 'DTE 25', 'cost_min' => 60, 'cost_max' => 110],
                ['name' => 'Óleo de engrenagens ISO VG 220 (20L)', 'brand' => 'Castrol', 'manufacturer_ref' => 'Optigear', 'cost_min' => 70, 'cost_max' => 130],
                ['name' => 'Graxa de lítio multifunções (400g)', 'brand' => 'Lubrax', 'manufacturer_ref' => 'GRAX-2', 'cost_min' => 8, 'cost_max' => 18],
                ['name' => 'Lubrificante para correntes (1L)', 'brand' => 'Molykote', 'manufacturer_ref' => 'MKC-1', 'cost_min' => 15, 'cost_max' => 30],
                ['name' => 'Óleo para compressores (20L)', 'brand' => 'Shell', 'manufacturer_ref' => 'Corena S4', 'cost_min' => 80, 'cost_max' => 150],
                ['name' => 'Fluido de corte para CNC (5L)', 'brand' => 'Blaser', 'manufacturer_ref' => 'B-Cool', 'cost_min' => 35, 'cost_max' => 65],
                ['name' => 'Graxa de alta temperatura (400g)', 'brand' => 'Mobil', 'manufacturer_ref' => 'XHP 222', 'cost_min' => 12, 'cost_max' => 24],
                ['name' => 'Desengordurante industrial (5L)', 'brand' => 'Loctite', 'manufacturer_ref' => 'DG-5', 'cost_min' => 18, 'cost_max' => 35],
            ],
            'Filtros' => [
                ['name' => 'Filtro de ar do compressor', 'brand' => 'Atlas Copco', 'manufacturer_ref' => '1622', 'cost_min' => 20, 'cost_max' => 40],
                ['name' => 'Filtro de óleo do compressor', 'brand' => 'Atlas Copco', 'manufacturer_ref' => '1604', 'cost_min' => 25, 'cost_max' => 50],
                ['name' => 'Separador de condensados', 'brand' => 'Parker', 'manufacturer_ref' => 'WS-10', 'cost_min' => 15, 'cost_max' => 30],
                ['name' => 'Cartucho de filtro de cabine', 'brand' => 'Camfil', 'manufacturer_ref' => 'H13', 'cost_min' => 45, 'cost_max' => 90],
                ['name' => 'Filtro de aspiração de pó', 'brand' => 'Donaldson', 'manufacturer_ref' => 'P189', 'cost_min' => 55, 'cost_max' => 100],
                ['name' => 'Filtro de admiração do gerador', 'brand' => 'Caterpillar', 'manufacturer_ref' => '1320', 'cost_min' => 18, 'cost_max' => 38],
                ['name' => 'Filtro de cabine da cabina do empilhador', 'brand' => 'Toyota', 'manufacturer_ref' => 'CF-8FBE', 'cost_min' => 22, 'cost_max' => 45],
                ['name' => 'Filtro magnético do quadro elétrico', 'brand' => 'Bauer', 'manufacturer_ref' => 'MG-400', 'cost_min' => 10, 'cost_max' => 22],
            ],
            'Sensores' => [
                ['name' => 'Sensor fotoelétrico retrorefletivo', 'brand' => 'Sick', 'manufacturer_ref' => 'WT12', 'cost_min' => 40, 'cost_max' => 75],
                ['name' => 'Sensor indutivo de proximidade M12', 'brand' => 'IFM', 'manufacturer_ref' => 'IGS204', 'cost_min' => 25, 'cost_max' => 48],
                ['name' => 'Sensor de pressão 0-10 bar', 'brand' => 'Wika', 'manufacturer_ref' => 'SP-10', 'cost_min' => 70, 'cost_max' => 130],
                ['name' => 'Encoder incremental E6B2', 'brand' => 'Omron', 'manufacturer_ref' => 'E6B2', 'cost_min' => 55, 'cost_max' => 95],
                ['name' => 'Sensor de temperatura PT100', 'brand' => 'Jumo', 'manufacturer_ref' => 'PT100', 'cost_min' => 18, 'cost_max' => 35],
                ['name' => 'Sensor de fluxo de ar', 'brand' => 'Festo', 'manufacturer_ref' => 'SFAW', 'cost_min' => 85, 'cost_max' => 150],
                ['name' => 'Sensor ultrassónico de nível', 'brand' => 'Pepperl+Fuchs', 'manufacturer_ref' => 'UC3000', 'cost_min' => 110, 'cost_max' => 190],
                ['name' => 'Sensor de fim de curso rolante', 'brand' => 'Omron', 'manufacturer_ref' => 'D4N', 'cost_min' => 15, 'cost_max' => 30],
            ],
        ];
    }

    /**
     * Nomes próprios e apelidos portugueses para técnicos.
     *
     * @return array{first: array<int, string>, last: array<int, string>}
     */
    public static function technicianNames(): array
    {
        return [
            'first' => [
                'Rui', 'João', 'André', 'Miguel', 'Pedro', 'Ricardo', 'Tiago', 'Fábio',
                'Bruno', 'Carlos', 'José', 'Nuno', 'Paulo', 'Sérgio', 'Hélder', 'Luís',
                'Marco', 'Vítor', 'Diogo', 'Francisco',
            ],
            'last' => [
                'Carvalho', 'Santos', 'Ferreira', 'Pereira', 'Oliveira', 'Rodrigues', 'Marques', 'Teixeira',
                'Costa', 'Moreira', 'Rocha', 'Martins', 'Sousa', 'Ribeiro', 'Almeida', 'Gomes',
                'Pinto', 'Barbosa', 'Correia', 'Antunes',
            ],
        ];
    }

    /**
     * Nomes e apelidos para reportantes de tickets públicos (QR / telefone / API).
     *
     * @return array{first: array<int, string>, last: array<int, string>}
     */
    public static function reporterNames(): array
    {
        return [
            'first' => [
                'Ana', 'Maria', 'Sofia', 'Carla', 'Inês', 'Beatriz', 'Carolina', 'Marta',
                'Filipa', 'Rita', 'Teresa', 'Joana', 'Sara', 'Margarida', 'Patrícia', 'Cátia',
                'Daniela', 'Vera', 'Helena', 'Cristina',
            ],
            'last' => [
                'Lopes', 'Silva', 'Cunha', 'Mendes', 'Pires', 'Matos', 'Neves', 'Reis',
                'Azevedo', 'Mota', 'Fonseca', 'Baptista', 'Lourenço', 'Coelho', 'Sequeira', 'Tavares',
                'Campos', 'Vieira', 'Cardoso', 'Freitas',
            ],
        ];
    }
}
