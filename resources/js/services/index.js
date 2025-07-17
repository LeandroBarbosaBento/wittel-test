import axios from 'axios';

export const getCustomers = async (params) => {
    const { data } = await axios.get("/api/customers/", {
        params: {
            page: params.page || 1,
            search: params.search || ''
        }
    });
    return data;
}

export const storeCustomer = async (params) => {
    const { data } = await axios.post("/api/customers/", params);
    return data;
}

export const getReport = async (period) => {
    const { data } = await axios.get("/api/customers/report",{
        params: {
            period: period
        }
    });
    return data;
}
