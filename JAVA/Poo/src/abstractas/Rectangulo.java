
package abstractas;

public class Rectangulo extends FiguraGeometrica{

    public Rectangulo(String TipoFigura) {
        super(TipoFigura);
    }
    
    
    @Override
    public void dibujar(){
        System.out.println("Se dibuja un " + this.getClass().getSimpleName());
    }
}
