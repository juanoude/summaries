package br.com.alura.javaIeIIexemplointerface;

class Circulo implements AreaCalculavel {
    private double raio;

    public Circulo(double raio) {
            this.raio = raio;
    }
    public double calculaArea() {
            return Math.PI * raio * raio;
    }
}