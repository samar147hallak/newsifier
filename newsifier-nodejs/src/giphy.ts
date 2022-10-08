import fetch from 'node-fetch';
import { giffUrl, pageSize } from './settings';

export const getGiff =  async (req: any, res: any) =>{
    const { params } = req;
    const { searchtext,offset } = params;
    try {
        const url = giffUrl+'&q=' + searchtext+'&limit='+pageSize+'&offset='+(offset*pageSize);
        const giffRes = await fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        });

        const giffs = await giffRes.json();
        res.json(giffs);

    } catch (e) {
        console.error(e);
        res.boom.badImplementation('Failed to get giffs');
    }

};

export const getGiffByURL =  async (req: any, res: any) =>{
    const { params } = req;
    const { searchtext } = params;
    try {
        const url =  searchtext
        const giffRes = await fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        });

        const giffs = await giffRes.json();
        res.json(giffs);

    } catch (e) {
        console.error(e);
        res.boom.badImplementation('Failed to get giffs');
    }

};