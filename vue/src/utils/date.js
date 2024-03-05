import dayjs from 'dayjs'
import ru from 'dayjs/locale/ru'

export default (date, format = 'DD-MM-YYYY HH:mm') => {
    if (date) {
        const _date = date === 'today' ? Date() : date
        let _format
        switch (format) {
            case 'iso':
                _format = 'YYYY-MM-DD'
                break
            default:
                _format = format
        }
        return dayjs(_date).locale(ru).format(_format)
    }
    return date
}
