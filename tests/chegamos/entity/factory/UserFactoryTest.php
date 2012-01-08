<?php

namespace chegamos\entity\factory;

class UserFactoryTest extends \PHPUnit_Framework_TestCase
{
    private $jsonString;

    protected function Setup()
    {
        $this->jsonStringFullUser = <<<JSON
{"user":{
	"id":"8972911185",
	"name":"Eher",
	"birthday":"1983-07-02",
	"gender":"M",
	"privileges":"0",
	"photo_large_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
	"photo_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
	"photo_medium_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_m.jpg",
	"photo_small_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_s.jpg",
	"stats":{
		"places":"61",
		"photos":"263",
		"reviews":"104",
		"visits":"1,152"
		}
	}	
}
JSON;
        $this->jsonStringReviewList = <<<JSON

{"user":{
	"id":"8972911185",
	"name":"Eher",
	"photo_large_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
	"photo_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
	"photo_medium_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_m.jpg",
	"photo_small_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_s.jpg",
	"result_count":"99",
	"current_page":"1",
	"reviews":[
		{"review":{
			"id":"504795",
			"place":{
				"id":"C40598455A220E220A",
				"name":"Espa\u00E7o Campolim",
				"point":{
					"lat":"-23.524",
					"lng":"-47.466"
					}
				},
			"rating":"2",
			"content":"Gostei muito da proposta do iLife do Espa\u00E7o Compolim. Trata-se de um Fast Food de Comidas saud\u00E1veis. Mas o que parece um sonho de consumo para muito fica muito distante da realidade. N\u00E3o \u00E9 a primeira vez que visito o lugar, mas com certeza foi a pior das experi\u00EAncias. Fiz o pedido do Angus Burger acompanhado de um Milk Shake, como o pr\u00F3prio card\u00E1pio destaca como pratos principais (n\u00E3o quis inventar moda). O Shake chegou r\u00E1pido, mas o Lanche demorou mais de 40 minutos (foram 53 minutos entre o registro do pedido e o pagamento). Voc\u00EAs tem que concordar que de Fast esse Food n\u00E3o tem nada!O lugar \u00E9 bem localizado ao lado da pista de caminhada do Parque Campolim mas n\u00E3o conta com estacionamento pr\u00F3prio (n\u00E3o que eu tenha encontrado). N\u00E3o \u00E9 um lugar que eu visitaria portando meu chinel\u00E3o, por ser frequentado pelos adolecentes cheios de pose e madames prensadas em trajes de academia. Os atendentes s\u00E3o realmente atenciosos. N\u00E3o consegui ser mal educado com nenhum deles. Tive a impress\u00E3o que o meu lanche s\u00F3 saiu depois que a pessoa que estava me atendendo foi pessoalmente preparar.Por ter passado um tempo consider\u00E1vel no estabelecimento pude reparar em alguns detalhes interessantes, como a m\u00E1quina de fazer sucos. \u00C9 um m\u00E1quina muito interessante que permite deixar uma certa quantidade de laranjas na parte de cima. Ao ligar o treco, uma laranja \u00E9 selecionada, cortada ao meio e em seguida dois bra\u00E7os mecanicos extraem o suco separando o baga\u00E7o. Tudo pode ser acompanhado pela frente da m\u00E1quina que possui um vidro transparente. Baseado nisso desenvolvi a teoria de que os atendentes preferem brincar com as m\u00E1quinas de suco do que fazer lanches. Enquando eu esperava o meu ficar pronto, acompanhei uma verdadeira linha de produ\u00E7\u00E3o de sucos.N\u00E3o posso deixar de chamar a aten\u00E7\u00E3o para o pre\u00E7o que \u00E9 bem salgado. Eu diria que 2x mais do que o Fast Food Tradicional.Em resumo, se voc\u00EA for ao iLife d\u00EA prefer\u00EAncia aos sucos. Mas se vc quiser s\u00F3 sucos, v\u00E1 a uma sucaria! :D",
			"created":{
				"timestamp":"2012-01-03T00:00:00",
				"user":{
					"id":"8972911185",
					"name":"Eher",
					"photo_large_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
					"photo_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
					"photo_medium_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_m.jpg",
					"photo_small_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_s.jpg"
					}
				}
			}
		},
		{"review":{
			"id":"491795",
			"place":{
				"id":"C40485391C196S1962",
				"name":"O Peda\u00E7o Da Pizza",
				"point":{
					"lat":"-23.593",
					"lng":"-46.684"
					}
				},
			"rating":"4",
			"content":"Experimente a pizza doce de Chocolate com M&Ms do \"Peda\u00E7o da Pizza\". ",
			"created":{
				"timestamp":"2011-12-22T00:00:00",
				"user":{
					"id":"8972911185",
					"name":"Eher",
					"photo_large_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
					"photo_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
					"photo_medium_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_m.jpg",
					"photo_small_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_s.jpg"
					}
				}
			}
		},
		{"review":{
			"id":"491777",
			"place":{
				"id":"4227BS9A",
				"name":"Pizza Hut",
				"point":{
					"lat":"-23.513",
					"lng":"-46.673"
					}
				},
			"rating":"4",
			"content":"As pizzas do Pizza Hut s\u00E3o excepcionais! Essa unidade, que fica na Marginal Tiete, tem estacionamento com manobrista. Se tiver fila de espera o atendimento tende a ser fraco.",
			"created":{
				"timestamp":"2011-12-22T00:00:00",
				"user":{
					"id":"8972911185",
					"name":"Eher",
					"photo_large_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
					"photo_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
					"photo_medium_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_m.jpg",
					"photo_small_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_s.jpg"
					}
				}
			}
		},
		{"review":{
			"id":"483932",
			"place":{
				"id":"VSMXMX8M",
				"name":"Terminal Rodovi\u00E1rio Da Barra Funda",
				"point":{
					"lat":"-23.529",
					"lng":"-46.661"
					}
				},
			"rating":"4",
			"content":"Quando estiver na rodovi\u00E1ria da Barra Funda experimente o Dog prensado. Eu gosto do n\u00FAmero 1 com Guaraviton. A barraca que vende o Dog fica em um centro comercial entre a rodovi\u00E1ria e o metro\/trem. ",
			"created":{
				"timestamp":"2011-12-14T00:00:00",
				"user":{
					"id":"8972911185",
					"name":"Eher",
					"photo_large_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
					"photo_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
					"photo_medium_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_m.jpg",
					"photo_small_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_s.jpg"
					}
				}
			}
		},
		{"review":{
			"id":"481497",
			"place":{
				"id":"C402766902570Q570C",
				"name":"OPERA DE ARAME",
				"point":{
					"lat":"-25.384",
					"lng":"-49.286"
					}
				},
			"rating":"5",
			"content":"Realmente a \u00D3pera de Arame \u00E9 um \u00F3timo passeio para quem est\u00E1 passando por Curitiba. Tem capacidade para 2.400 espectadores e um palco de 400m\u00B2 destinado a apresenta\u00E7\u00F5es art\u00EDsticas e culturais.\u00C9 um dos pontos da linha turistica, que na minha opini\u00E3o \u00E9 a forma mais simp\u00E1tica de conhecer a cidade.N\u00E3o deixe de tirar algumas fotos do lago com carpas e da cascata.",
			"created":{
				"timestamp":"2011-12-11T00:00:00",
				"user":{
					"id":"8972911185",
					"name":"Eher",
					"photo_large_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
					"photo_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
					"photo_medium_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_m.jpg",
					"photo_small_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_s.jpg"
					}
				}
			}
		},
		{"review":{
			"id":"456915",
			"place":{
				"id":"M25GJ288",
				"name":"Apontador.com - S\u00E3o Paulo",
				"point":{
					"lat":"-23.592",
					"lng":"-46.687"
					}
				},
			"rating":"5",
			"content":"Agora tamb\u00E9m tem o http:\/\/m.apontador.com.br\/ para vc acessar do seu celular.... :D",
			"created":{
				"timestamp":"2011-11-13T00:00:00",
				"user":{
					"id":"8972911185",
					"name":"Eher",
					"photo_large_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
					"photo_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
					"photo_medium_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_m.jpg",
					"photo_small_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_s.jpg"
					}
				}
			}
		},
		{"review":{
			"id":"453448",
			"place":{
				"id":"C406230420294O294C",
				"name":"Kikko Caf\u00E9",
				"point":{
					"lat":"-23.592",
					"lng":"-46.687"
					}
				},
			"rating":"5",
			"content":"Tente misturar o caf\u00E9 expresso com chocolate!",
			"created":{
				"timestamp":"2011-11-09T00:00:00",
				"user":{
					"id":"8972911185",
					"name":"Eher",
					"photo_large_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
					"photo_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
					"photo_medium_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_m.jpg",
					"photo_small_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_s.jpg"
					}
				}
			}
		},
		{"review":{
			"id":"453208",
			"place":{
				"id":"C406230420294O294C",
				"name":"Kikko Caf\u00E9",
				"point":{
					"lat":"-23.592",
					"lng":"-46.687"
					}
				},
			"rating":"5",
			"content":"Seria legal ter \u00E1gua quente para o cup noodles... :)",
			"created":{
				"timestamp":"2011-11-08T00:00:00",
				"user":{
					"id":"8972911185",
					"name":"Eher",
					"photo_large_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
					"photo_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
					"photo_medium_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_m.jpg",
					"photo_small_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_s.jpg"
					}
				}
			}
		},
		{"review":{
			"id":"451577",
			"place":{
				"id":"42XG2ZU2",
				"name":"PRINC DO FUNCHAL",
				"point":{
					"lat":"-23.594",
					"lng":"-46.69"
					}
				},
			"rating":"4",
			"content":"J\u00E1 fazia um tempo que eu n\u00E3o tomava caf\u00E9 da manh\u00E3 no Princesinha da Funchal. Recentemente eu tomei um chocolate com bauru (salgado) e fiquei impressionado com o atendimento. Pessoal muito \u00E1gil e simp\u00E1tico. Gostei muito! ",
			"created":{
				"timestamp":"2011-11-07T00:00:00",
				"user":{
					"id":"8972911185",
					"name":"Eher",
					"photo_large_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
					"photo_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
					"photo_medium_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_m.jpg",
					"photo_small_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_s.jpg"
					}
				}
			}
		},
		{"review":{
			"id":"447741",
			"place":{
				"id":"C40482381F145Z1450",
				"name":"Villa S\u00E3o Leoncio",
				"point":{
					"lat":"-23.499",
					"lng":"-46.614"
					}
				},
			"rating":"5",
			"content":"Gostei muito, parab\u00E9ns!",
			"created":{
				"timestamp":"2011-11-02T00:00:00",
				"user":{
					"id":"8972911185",
					"name":"Eher",
					"photo_large_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
					"photo_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
					"photo_medium_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_m.jpg",
					"photo_small_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_s.jpg"
					}
				}
			}
		},
		{"review":{
			"id":"447040",
			"place":{
				"id":"88F6542J",
				"name":"Villa Dos P\u00E3es",
				"point":{
					"lat":"-23.593",
					"lng":"-46.684"
					}
				},
			"rating":"2",
			"content":"Tentei almo\u00E7ar no andar de cima mas n\u00E3o consegui. O lugar \u00E9 muito abafado e tem um cheiro estranho. Isso somado ao pre\u00E7o do almo\u00E7o me fez desistir antes de experimentar.",
			"created":{
				"timestamp":"2011-11-01T00:00:00",
				"user":{
					"id":"8972911185",
					"name":"Eher",
					"photo_large_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
					"photo_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
					"photo_medium_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_m.jpg",
					"photo_small_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_s.jpg"
					}
				}
			}
		},
		{"review":{
			"id":"439433",
			"place":{
				"id":"C405139338614U6146",
				"name":"Frutaria Saziki",
				"point":{
					"lat":"-23.52",
					"lng":"-47.465"
					}
				},
			"rating":"5",
			"content":"A Frutaria Saziki \u00E9 um \u00F3timo lugar para tomar um suco ou vitamina nos dias quentes de Sorocaba.O lugar conta com um espa\u00E7o legal para fazer uma refei\u00E7\u00E3o saud\u00E1vel.Eles preparam sandu\u00EDches tamb\u00E9m.O ponto fraco \u00E9 o estacionamento que fica em cima do lugar. Muito complicado de entrar e sair. Existem duas vagas simp\u00E1ticas na frente, mas se estiverem ocupadas recomendo parar no estacionamento ao lado da Real (em frente \u00E0 Frutaria Saziki).Em resumo, vale muito a pena conhecer.",
			"created":{
				"timestamp":"2011-10-23T00:00:00",
				"user":{
					"id":"8972911185",
					"name":"Eher",
					"photo_large_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
					"photo_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
					"photo_medium_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_m.jpg",
					"photo_small_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_s.jpg"
					}
				}
			}
		},
		{"review":{
			"id":"435281",
			"place":{
				"id":"CJ593BN6",
				"name":"Sorotaxi Associa\u00E7\u00E3o Dos Taxistas De Sorocaba E Regi\u00E3o",
				"point":{
					"lat":"-23.487",
					"lng":"-47.478"
					}
				},
			"rating":"5",
			"content":"Acredito que a Sorotaxi \u00E9 forma mais segura de pegar um T\u00E1xi em Sorocaba. Basta ligar que as simp\u00E1ticas atendentes mandam algu\u00E9m para te levar onde vc precisa. Eles t\u00EAm planos para empresas e tamb\u00E9m fazem viagens.Alguns carros est\u00E3o equipados com gps interligado com a central. Neste caso, o motorista tem a rota tra\u00E7ada na tela e o tempo estimado antes do passageiro entrar no carro.Legal, n\u00E9?",
			"created":{
				"timestamp":"2011-10-18T00:00:00",
				"user":{
					"id":"8972911185",
					"name":"Eher",
					"photo_large_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
					"photo_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
					"photo_medium_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_m.jpg",
					"photo_small_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_s.jpg"
					}
				}
			}
		},
		{"review":{
			"id":"431936",
			"place":{
				"id":"2U87G53J",
				"name":"Gigio Pastel",
				"point":{
					"lat":"-23.507",
					"lng":"-47.463"
					}
				},
			"rating":"4",
			"content":"O Pastel do Gigios \u00E9 muito conhecido em Sorocaba. Realmente vale a pena experimentar o rod\u00EDzio de pastel e pizza.Depois dessa febre de cupoms o lugar vive lotado, ent\u00E3o ligue antes para saber se n\u00E3o \u00E9 o \u00FAltimo dia de validade de alguma promo\u00E7\u00E3o.Recomendo o pastel \"Grego\" que vem com bacon, ovo e azeitona. O atendimento \u00E9 ponto forte, sendo todos muito educados e atenciosos. A demora realmente pode incomodar os admiradores do fast food. Mas se o seu neg\u00F3cio \u00E9 juntar alguns amigos para conversar, esse \u00E9 o lugar certo.Infelizmente eles n\u00E3o tem estacionamento, mas procure uma vaguinha na rua   Antonio Soares que sempre tem.Ah! Eles tamb\u00E9m tem um esquema de delivery.",
			"created":{
				"timestamp":"2011-10-13T00:00:00",
				"user":{
					"id":"8972911185",
					"name":"Eher",
					"photo_large_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
					"photo_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
					"photo_medium_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_m.jpg",
					"photo_small_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_s.jpg"
					}
				}
			}
		},
		{"review":{
			"id":"428464",
			"place":{
				"id":"29T6PU6M",
				"name":"Condom\u00EDnio Edif\u00EDcio Montreal",
				"point":{
					"lat":"-23.592",
					"lng":"-46.687"
					}
				},
			"rating":"2",
			"content":"O Condom\u00EDnio Edif\u00EDcio Montreal deixa muito a desejar em organiza\u00E7\u00E3o e administra\u00E7\u00E3o. Quem trabalha l\u00E1 sabe que os elevadores n\u00E3o s\u00E3o confi\u00E1veis e travam sem mais nem menos. Da \u00FAltima vez que fiquei preso, foram 30 minutos da minha vida jogados fora. A falta de capacida para organizar a recepc\u00E3o obriga todos a passarem pela catraca e por consequencia pelos elevadores j\u00E1 citados.J\u00E1 n\u00E3o \u00E9 novidade na regi\u00E3o, mas \u00E9 preciso falar que o estacionamento do condom\u00EDnio enfia a faca. Seja quem vai deixar o carro algumas horas, ou o coitado do mensalista que n\u00E3o tem outra op\u00E7\u00E3o. Por esta falta de op\u00E7\u00E3o, os respons\u00E1veis pelo estacionamento n\u00E3o se empenham muito em ser simp\u00E1ticos na hora de resolver qualquer dificultade. A pol\u00EDtica parece ser \"N\u00E3o est\u00E1 feliz, procura outro\".Lament\u00E1vel!",
			"created":{
				"timestamp":"2011-10-10T00:00:00",
				"user":{
					"id":"8972911185",
					"name":"Eher",
					"photo_large_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
					"photo_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
					"photo_medium_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_m.jpg",
					"photo_small_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_s.jpg"
					}
				}
			}
		},
		{"review":{
			"id":"428440",
			"place":{
				"id":"K7ZMX9ZQ",
				"name":"BONGA DELIVERY",
				"point":{
					"lat":"-23.498",
					"lng":"-47.469"
					}
				},
			"rating":"5",
			"content":"Genial o servi\u00E7o do Bonga Delivery! Eles s\u00E3o o servi\u00E7o de entrega mais completo que eu j\u00E1 vi em Sorocaba. Basta ligar e conferir quais s\u00E3o as op\u00E7\u00F5es. Eles t\u00EAm pizzas, grelhados, parmegianas, lanches e o que mais a sua fome pedir.Recomendo o X-Egg!",
			"created":{
				"timestamp":"2011-10-10T00:00:00",
				"user":{
					"id":"8972911185",
					"name":"Eher",
					"photo_large_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
					"photo_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
					"photo_medium_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_m.jpg",
					"photo_small_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_s.jpg"
					}
				}
			}
		},
		{"review":{
			"id":"408887",
			"place":{
				"id":"C405456443174E1748",
				"name":"Subway Rubem Berta",
				"point":{
					"lat":"-23.615",
					"lng":"-46.659"
					}
				},
			"rating":"4",
			"content":"Nada mais pr\u00E1tico do que um Subway em um posto. Quem n\u00E3o gosta de Subway?! \u00C9 o \u00FAnico lugar que eu conhe\u00E7o que vc pode montar o lanche como preferir. Gosto do meu com p\u00E3o integral, almondegas, queijo chedar em dobro, quente, azeitona, salada e molho barbecue. Hummmm... Uma del\u00EDcia! ",
			"created":{
				"timestamp":"2011-09-14T00:00:00",
				"user":{
					"id":"8972911185",
					"name":"Eher",
					"photo_large_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
					"photo_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
					"photo_medium_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_m.jpg",
					"photo_small_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_s.jpg"
					}
				}
			}
		},
		{"review":{
			"id":"407264",
			"place":{
				"id":"2J23Q2CX",
				"name":"Banca Campolim",
				"point":{
					"lat":"-23.522",
					"lng":"-47.465"
					}
				},
			"rating":"5",
			"content":"Quem v\u00EA de fora n\u00E3o imagina a quantidade de revistas, livros e brinquedos!Entrei inocentemente para comprar gogo's da turma da m\u00F4nica e n\u00E3o pude deixar de dar uma olhada em todo o resto.Eles tamb\u00E9m tem action figures e pelucias (tem at\u00E9 Mario e angry birds!).O atendimento condiz com a qualidade do estabelecimento. Est\u00E3o de parab\u00E9ns!",
			"created":{
				"timestamp":"2011-09-13T00:00:00",
				"user":{
					"id":"8972911185",
					"name":"Eher",
					"photo_large_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
					"photo_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
					"photo_medium_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_m.jpg",
					"photo_small_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_s.jpg"
					}
				}
			}
		},
		{"review":{
			"id":"401705",
			"place":{
				"id":"8288HNLZ",
				"name":"Shopping Metr\u00F4 Santa Cruz",
				"point":{
					"lat":"-23.599",
					"lng":"-46.637"
					}
				},
			"rating":"4",
			"content":"Realmente o Shopping Santa Cruz \u00E9 bom para quem est\u00E1 no metr\u00F4 e quer dar uma esticadinha para comer algo ou pegar um filminho. Para ambos os casos o destino \u00E9 o \u00FAltimo andar do Shopping.N\u00E3o pense que vai ser f\u00E1cil pois vc vai ser obrigado a passar por todas as vitrines, pela disposi\u00E7\u00E3o das escadas rolantes. Ser\u00E1 que fizeram isso sem querer? :)",
			"created":{
				"timestamp":"2011-09-05T00:00:00",
				"user":{
					"id":"8972911185",
					"name":"Eher",
					"photo_large_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
					"photo_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
					"photo_medium_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_m.jpg",
					"photo_small_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_s.jpg"
					}
				}
			}
		},
		{"review":{
			"id":"401691",
			"place":{
				"id":"C4058278614E3Q4E37",
				"name":"Walmart Sorocaba",
				"point":{
					"lat":"-23.517",
					"lng":"-47.466"
					}
				},
			"rating":"4",
			"content":"O Walmart Sorocaba tem dois andares de estacionamento. Os mesmos andares, que ao lado das escadas rolantes, t\u00EAm quiosques e espa\u00E7os de conveni\u00EAncias (farm\u00E1cia, lanchonete, inform\u00E1tica, cartucho para impressora, turismo, caf\u00E9, dunets, etc).O Walmart possui uma variedade razoav\u00E9l de marcas. Seu compromisso \u00E9 com pre\u00E7os baixos, sendo esse o seu diferencial.Recentemente mudaram o espa\u00E7o para fazer um lanche dentro do supermercado, que antes ficava no fundo da loja, para o centro perto dos caixas (ao lado das frutas). O ponto fraco ficou para os carrinhos, que j\u00E1 n\u00E3o s\u00E3o t\u00E3o novos. \u00C9 uma briga para achar um que preste e consiga andar reto sem muito esfor\u00E7o.",
			"created":{
				"timestamp":"2011-09-05T00:00:00",
				"user":{
					"id":"8972911185",
					"name":"Eher",
					"photo_large_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
					"photo_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
					"photo_medium_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_m.jpg",
					"photo_small_url":"http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_s.jpg"
					}
				}
			}
		}
		]
	}
}
JSON;
    }

    protected function TearDown()
    {
        unset($this->userJson);
    }

    public function testGenerateFullUser()
    {
        $userJson = json_decode($this->jsonStringFullUser);
        $user = UserFactory::generate($userJson->user);
        $this->assertEquals("8972911185", $user->getId());
        $this->assertEquals("Eher", $user->getName());
        $this->assertEquals("02/07/83", $user->getBirthday());
        $this->assertEquals("Masculino", $user->getGender());
        $this->assertEquals(
            "http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg", 
            $user->getPhotoUrl()
        );
        $this->assertEquals(
            "http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_m.jpg", 
            $user->getPhotoMediumUrl()
        );
        $this->assertEquals(
            "http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_s.jpg", 
            $user->getPhotoSmallUrl()
        );
        $this->assertEquals("61", $user->getStats()->getPlaces());
        $this->assertEquals("263", $user->getStats()->getPhotos());
        $this->assertEquals("104", $user->getStats()->getReviews());
    }
    
    public function testGenerateReviewList()
    {
        $userJson = json_decode($this->jsonStringReviewList);
        $user = UserFactory::generate($userJson->user);
        $this->assertEquals("8972911185", $user->getId());
        $this->assertEquals("Eher", $user->getName());
        $this->assertEquals(
            "http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_b.jpg",
            $user->getPhotoUrl()
        );
        $this->assertEquals(
            "http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_m.jpg",
            $user->getPhotoMediumUrl()
        );
        $this->assertEquals(
            "http://aptuser.s3.amazonaws.com/8972911185_11409941208494478_s.jpg",
            $user->getPhotoSmallUrl()
        );
        $this->assertEquals(
            "99",
            $user->getReviews()->getNumFound()
        );
        $this->assertEquals(
            "1",
            $user->getReviews()->getCurrentPage()
        );
        $this->assertEquals(
            "chegamos\entity\container\ReviewList",
            get_class($user->getReviews())
        );
        $this->assertEquals(
            "chegamos\entity\Review",
            get_class($user->getReviews()->getItem())
        );
        $this->assertEquals(
            "Agora também tem o http://m.apontador.com.br/ para vc acessar do seu celular.... :D",
            $user->getReviews()->getItem(5)->getContent()
        );
    }
}
