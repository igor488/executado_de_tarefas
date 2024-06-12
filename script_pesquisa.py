import sys

if len(sys.argv) > 1:
    pesquisa = sys.argv[1]
    # Simula uma pesquisa
    print(f'Resultado da pesquisa para: {pesquisa}')
else:
    print("Nenhuma pesquisa fornecida")
