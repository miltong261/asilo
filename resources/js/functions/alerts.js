export function sweetAlert(tipo, mensaje) {
    const toast = swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        padding: '2em'
    })

    toast({
        type: tipo,
        title: mensaje,
        padding: '2em',
    })
}
