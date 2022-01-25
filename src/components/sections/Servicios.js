import useFetch from "../../hooks/useFetch"

const Servicios = ({ peticion }) => {

    const [data, error] = useFetch(peticion);

    if(!data){
        return <span>No hay servicios</span>
    }
    if(error){
        <h1>Error Servicios</h1>
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