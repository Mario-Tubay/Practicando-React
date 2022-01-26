import {number, string} from "prop-types";

const Cupcakes = ({ descripcion, imagen, sabor, color, precio }) =>{
    return (
        <div className="s-radius-1 s-shadow-bottom background s-shadow-card-micro white-color s-pxy-2">
            <img  src={ imagen } alt={sabor} />
            <p> {descripcion} </p>
            <span>Color: { color }</span>
            <br />
            <span>Precio: { precio }</span>
        </div>
    );
}

Cupcakes.propTypes = {
    precio:number,
    color:string.isRequired,
    descripcion:string.isRequired,
    sabor:string.isRequired,
    imagen:string
}
Cupcakes.defaultProps = {
    imagen: "https://previews.123rf.com/images/sabelskaya/sabelskaya1707/sabelskaya170700406/81950068-blanco-y-negro-cupcake-dibujado-a-mano-con-crema-perfecta-remolinos-y-asperja-ilustraci%C3%B3n-vectorial-.jpg",
    precio: 0
}
export default Cupcakes;