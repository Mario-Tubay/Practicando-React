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

export default Cupcakes;