import axios from 'axios';

const API_URL = '/api/customers/';

export const getCustomers = async (params) => {
    const { data } = await axios.get(API_URL, {
        params: {
            page: params.page || 1,
            search: params.search || ''
        }
    });
    return data;
}

export const storeCustomer = async (params) => {
    const { data } = await axios.post(API_URL, params);
    return data;
}
