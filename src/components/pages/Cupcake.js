import Cupcakes from "../cards/Cupcakes"
import useFetch from "../../hooks/useFetch"
import Axios from "axios"
import { useState, useEffect } from "react";



const Cupcake = ( {peticion, title} ) => {
    // console.log(peticion)

    // const [cupcakes, setCupcake] = useState();

    // useEffect(()=>{
    //     Axios.get(`${process.env.REACT_APP_URL_API}${peticion}`)//es una promesa
    //     .then(({data}) => setCupcake(data))//muestro lo que me manda la base 


    //     // fetch(`${process.env.REACT_APP_URL_API}${peticion}`)//es una promesa
    //     // .then(response => response.json())//1er me tranforma en json 
    //     // .then(data => setCupcake(data))//muestro lo que me manda la base 
    //     // .catch(e =>console.log(e))
    // },[peticion])

    const [data, error] = useFetch(peticion);
    if(error){
        <h1>Error</h1>
    }
    return(
        <div>
            { title && <h1>Pagina de Cupcake</h1>} 
            <div>
            { 
                    data ? (// esto viene a ser un if pero se le llama condicional ternerario, lo que estamos haciendo es que si no carga ek contenido muestre la palabra cargando
                    <section  className="ed-grid s-grid-2 s-grid-3 lg-grid-4 row-gap">    
                        { data.map(( {
                            descripcion, imagen, sabor, color, precio, id
                        }) => 
                            <Cupcakes 
                                key = {id}
                                descripcion={descripcion} 
                                imagen ={imagen}
                                precio= { precio }
                                color= { color } 
                                sabor= { sabor }

                            />
                            )
                        }
                    </section>
                    )  : (<span>Cargando.....</span>)
                }
            </div>
        </div>
    )
    
}

export default Cupcake;