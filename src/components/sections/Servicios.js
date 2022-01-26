import useFetch from "../../hooks/useFetch"

const Servicios = ({ peticion }) => {

    const [data, error] = useFetch(peticion);

    console.log(data)
    console.log(error)
    if(error){
        <h1>Error Servicios</h1>
    }
    if(!data || data.length == 0){
        return <span>No hay servicios</span>
    }
    return  (
        <div className="ed-grid">
           {
               data.map(s => (
                 <div key={s.id}>
                     <h2>{s.nombre}</h2>
                     <p>{s.descripcion}</p>
                 </div>
               ))
           }
        </div>
    )
}

export default Servicios