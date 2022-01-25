import { useEffect, useState } from "react"
import {get} from "axios"

const useFetch = (endpoint) => {
    const [data, setData] = useState();

    const [error , setError] = useState();

    useEffect (()=>{
        get(`${process.env.REACT_APP_URL_API}${endpoint}`)
        .then(({data}) => setData(data))
        .catch(err => setError(err))
    },[endpoint])

    return [data, error];
}

export default useFetch