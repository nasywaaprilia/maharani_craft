<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var list<string>
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
    public $category = [
        'id_kategori' => 'required|is_unique[kategori.id_kategori]',
        'nama_kategori' => 'required',
        ];
        public $category_errors = [
        'id_kategori' => [
        'required' => 'Id Kategori wajib diisi.',
        'is_unique' => 'ID Kategori sudah digunakan. Gunakan ID yang lain.'
        ],
        'nama_kategori' => [
        'required' => 'Nama category wajib diisi.'
        ]
        ];

        public $category_edit = [
            'id_kategori' => 'required',
            'nama_kategori' => 'required'
        ];
        
        public $category_edit_errors = [
            'id_kategori' => [
                'required' => 'Id Kategori wajib diisi.'
            ],
            'nama_kategori' => [
                'required' => 'Nama kategori wajib diisi.'
            ]
        ];
    
    public $product = [
    'id_kategori'          => 'required',
    'id_produk'            => 'required|is_unique[produk.id_produk]',
    'nama_produk'         => 'required',
    'satuan'         => 'required',
    'harga_produk'        => 'required',
    'gambar_produk'        => 'uploaded[gambar_produk]|mime_in[gambar_produk,image/jpg,image/jpeg,image/gif,image/png]|max_size[gambar_produk,1000]',
    'deskripsi_produk'  => 'required'
];
public $product_errors = [
    'id_kategori' => [
        'required' => 'Nama category wajib diisi.'
    ],
    'id_produk' => [
        'is_unique'  => 'ID produk sudah digunakan. Gunakan ID yang lain.'
    ],
    'nama_produk' => [
        'required' => 'Nama product wajib diisi.'
    ],
    'satuan' => [
        'required' => 'satuan product wajib diisi.'
    ],
    'harga_produk' => [
        'required' => 'Harga product wajib diisi.'
    ],
    'gambar_produk' => [
        'mime_in'  => 'Gambar product hanya boleh diisi dengan jpg, jpeg, png atau gif.',
        'max_size' => 'Gambar product maksimal 1mb',
        'uploaded' => 'Gambar product wajib diisi'
    ],
    'deskripsi_produk' => [
        'required' => 'Description product wajib diisi.'
    ]
];

public $product_edit = [
    'id_kategori'          => 'required',
    'id_produk'            => 'required',
    'nama_produk'         => 'required',
    'satuan'              => 'required',
    'harga_produk'        => 'required',
    'gambar_produk'        => 'permit_empty|mime_in[gambar_produk,image/jpg,image/jpeg,image/gif,image/png]|max_size[gambar_produk,1000]',
    'deskripsi_produk'  => 'required'
];
public $product_edit_errors = [
    'id_kategori' => [
        'required' => 'Nama category wajib diisi.'
    ],
    'id_produk' => [
        'is_unique'  => 'ID produk sudah digunakan. Gunakan ID yang lain.'
    ],
    'nama_produk' => [
        'required' => 'Nama product wajib diisi.'
    ],
    'satuan' => [
        'required' => 'satuan product wajib diisi.'
    ],
    'harga_produk' => [
        'required' => 'Harga product wajib diisi.'
    ],
    'gambar_produk' => [
        'mime_in'  => 'Gambar product hanya boleh diisi dengan jpg, jpeg, png atau gif.',
        'max_size' => 'Gambar product maksimal 1mb',
        'uploaded' => 'Gambar product wajib diisi'
    ],
    'deskripsi_produk' => [
        'required' => 'Description product wajib diisi.'
    ]
];

public $authlogin = [
    'username'         => 'required|alpha_numeric',
    'password'      => 'required'
];

public $authlogin_errors = [
    'username'=> [
        'required'  => 'Username wajib diisi.',
        'alpha_numeric'   => 'Username tidak valid'
    ],
    'password'=> [
        'required'  => 'Password wajib diisi.'
    ]
];

public $authregister = [
    'email'             => 'required|valid_email|is_unique[users.email]',
    'username'          => 'required|alpha_numeric|is_unique[users.username]|min_length[8]|max_length[35]',
    'name'              => 'required|alpha_numeric_space|min_length[3]|max_length[35]',
    'password'          => 'required|string|min_length[8]|max_length[35]',
    'confirm_password'  => 'required|string|matches[password]|min_length[8]|max_length[35]',
];

public $authregister_errors = [
    'email'=> [
        'required'      => 'Email wajib diisi',
        'valid_email'   => 'Email tidak valid',
        'is_unique'     => 'Email sudah terdaftar'
    ],
    'username'=> [
        'required'      => 'Username wajib diisi',
        'alpha_numeric' => 'Username hanya boleh berisi huruf dan angka',
        'is_unique'     => 'Username sudah terdaftar',
        'min_length'    => 'Username minimal 8 karakter',
        'max_length'    => 'Username maksimal 35 karakter'
    ],
    'name'=> [
        'required'              => 'Name wajib diisi',
        'alpha_numeric_spaces'  => 'Name hanya boleh berisi huruf, angka dan spasi',
        'min_length'            => 'Name minimal 3 karakter',
        'max_length'            => 'Name maksimal 35 karakter'
    ],
    'password'=> [
        'required'      => 'Password wajib diisi',
        'string'        => 'Password hanya boleh berisi huruf, angka, spasi dan karakter lain',
        'min_length'    => 'Password minimal 8 karakter',
        'max_length'    => 'Password maksimal 35 karakter'
    ],
    'confirm_password'=> [
        'required'      => 'Konfirmasi password wajib diisi',
        'string'        => 'Konfirmasi password hanya boleh berisi huruf, angka, spasi dan karakter lain',
        'matches'       => 'Konfirmasi password tidak sama dengan password',
        'min_length'    => 'Konfirmasi password minimal 8 karakter',
        'max_length'    => 'Konfirmasi password maksimal 35 karakter'
    ]
];

public $hasilproduksi = [
    'id_produksi' => 'required|is_unique[hasilproduksi.id_produksi]',
    'id_produk' => 'required',
    'tanggal_produksi' => 'required|valid_date',
    'stok_produk' => 'required|integer|greater_than[0]',
    'keterangan' => 'permit_empty|string'
];

public $hasilproduksi_errors = [
    'id_produksi' => [
        'required' => 'ID produksi wajib diisi.',
        'is_unique' => 'ID Kategori sudah digunakan. Gunakan ID yang lain.'
    ],
    'id_produk' => [
        'required' => 'Produk wajib dipilih.'
    ],
    'tanggal_produksi' => [
        'required' => 'Tanggal produksi wajib diisi.',
        'valid_date' => 'Tanggal tidak valid.'
    ],
    'satuan'=> [
        'required' => 'Satuan wajib dipilih.'
    ],
    'stok_produk' => [
        'required' => 'Stok hasil produksi wajib diisi.',
        'integer' => 'Stok harus berupa angka.',
        'greater_than' => 'Stok harus lebih dari 0.'
    ]
];

public $hasilproduksi_edit = [
    'id_produksi' => 'required',
    'id_produk' => 'required',
    'tanggal_produksi' => 'required|valid_date',
    'stok_produk' => 'required|integer|greater_than[0]',
    'satuan'=>'required',
    'keterangan' => 'permit_empty|string'
];

public $hasilproduksi_edit_errors = [
    'id_produksi' => [
        'required' => 'ID produksi wajib diisi.',
        'is_unique' => 'ID Kategori sudah digunakan. Gunakan ID yang lain.'
    ],
    'id_produk' => [
        'required' => 'Produk wajib dipilih.'
    ],
    'tanggal_produksi' => [
        'required' => 'Tanggal produksi wajib diisi.',
        'valid_date' => 'Tanggal tidak valid.'
    ],
    'stok_produk' => [
        'required' => 'Stok hasil produksi wajib diisi.',
        'integer' => 'Stok harus berupa angka.',
        'greater_than' => 'Stok harus lebih dari 0.'
    ]
];


public $supplier = [
    'id_supplier' => 'required|is_unique[supplier.id_supplier]',
    'nama_supplier' => 'required',
    'alamat' => 'required'
    ];
    public $supplier_errors = [
    'id_supplier' => [
        'required' => 'ID Supplier wajib diisi.',
        'is_unique' => 'ID Supplier sudah digunakan. Gunakan ID yang lain.'
    ],
    'nama_supplier' => [
    'required' => 'Nama supplier wajib diisi.',
    ],
    'alamat' => [
    'required' => 'Alamat supplier wajib diisi.'
    ]
    ];

    public $supplier_edit = [
        'id_supplier' => 'required',
        'nama_supplier' => 'required',
        'alamat' => 'required'
        ];
        public $supplier_edit_errors = [
        'id_supplier' => [
            'required' => 'ID Supplier wajib diisi.',
            'is_unique' => 'ID Supplier sudah digunakan. Gunakan ID yang lain.'
        ],
        'nama_supplier' => [
        'required' => 'Nama supplier wajib diisi.',
        ],
        'alamat' => [
        'required' => 'Alamat supplier wajib diisi.'
        ]
        ];
    
    public $bahankeluar = [
        'id_bahankeluar' => 'required|is_unique[bahan_keluar.id_bahankeluar]',
        'id_produksi' => 'required',
        'id_bahan' => 'required',
        'jumlah' => 'required|integer|greater_than[0]',
        'tanggal' => 'required|valid_date'
    ];

    public $bahankeluar_errors = [
        'id_bahankeluar' => [
            'required' => 'ID bahan keluar wajib diisi.',
            'is_unique' => 'ID Bahan Keluar sudah digunakan. Gunakan ID yang lain.'
        ],
        'id_produksi' => [
            'required' => 'ID produksi wajib dipilih.'
        ],
        'id_bahan' => [
            'required' => 'Bahan wajib dipilih.'
        ],
        'jumlah' => [
            'required' => 'Jumlah bahan wajib diisi.',
            'integer' => 'Jumlah harus berupa angka.',
            'greater_than' => 'Jumlah harus lebih dari 0.'
        ],
        'tanggal' => [
            'required' => 'Tanggal keluar wajib diisi.',
            'valid_date' => 'Tanggal tidak valid.'
        ]
    ];
    
    public $bahankeluar_edit = [
        'id_bahankeluar' => 'required',
        'id_produksi' => 'required',
        'id_bahan' => 'required',
        'jumlah' => 'required|integer|greater_than[0]',
        'tanggal' => 'required|valid_date'
    ];

    public $bahankeluar_edit_errors = [
        'id_bahankeluar' => [
            'required' => 'ID bahan keluar wajib diisi.',
            'is_unique' => 'ID Bahan Keluar sudah digunakan. Gunakan ID yang lain.'
        ],
        'id_produksi' => [
            'required' => 'ID produksi wajib dipilih.'
        ],
        'id_bahan' => [
            'required' => 'Bahan wajib dipilih.'
        ],
        'jumlah' => [
            'required' => 'Jumlah bahan wajib diisi.',
            'integer' => 'Jumlah harus berupa angka.',
            'greater_than' => 'Jumlah harus lebih dari 0.'
        ],
        'tanggal' => [
            'required' => 'Tanggal keluar wajib diisi.',
            'valid_date' => 'Tanggal tidak valid.'
        ]
    ];
    public $listpo = [
        'id_po' => 'required|is_unique[listpo.id_po]',
        'id_produk' => 'required',
        'nama_customer' => 'required',
        'jumlah' => 'required|integer|greater_than[0]',
        'tanggal' => 'required|valid_date'
    ];

    public $listpo_errors = [
        'id_po' => [
            'required' => 'ID PO wajib diisi.',
            'is_unique' => 'ID PO sudah digunakan. Gunakan ID yang lain.'
        ],
        'id_produk' => [
            'required' => 'Produk wajib dipilih.'
        ],
        'nama_customer' => [
            'required' => 'Nama customer wajib diisi.'
        ],
        'jumlah' => [
            'required' => 'Jumlah wajib diisi.',
            'integer' => 'Jumlah harus berupa angka.',
            'greater_than' => 'Jumlah harus lebih dari 0.'
        ],
        'tanggal' => [
            'required' => 'Tanggal PO wajib diisi.',
            'valid_date' => 'Tanggal tidak valid.'
        ]
    ];

    public $listpo_edit = [
        'id_po' => 'required',
        'id_produk' => 'required',
        'nama_customer' => 'required',
        'jumlah' => 'required|integer|greater_than[0]',
        'tanggal' => 'required|valid_date'
    ];

    public $listpo_edit_errors = [
        'id_po' => [
            'required' => 'ID PO wajib diisi.',
            'is_unique' => 'ID PO sudah digunakan. Gunakan ID yang lain.'
        ],
        'id_produk' => [
            'required' => 'Produk wajib dipilih.'
        ],
        'nama_customer' => [
            'required' => 'Nama customer wajib diisi.'
        ],
        'jumlah' => [
            'required' => 'Jumlah wajib diisi.',
            'integer' => 'Jumlah harus berupa angka.',
            'greater_than' => 'Jumlah harus lebih dari 0.'
        ],
        'tanggal' => [
            'required' => 'Tanggal PO wajib diisi.',
            'valid_date' => 'Tanggal tidak valid.'
        ]
    ];
    
    public $bahanbakumasuk = [
        'id_bahan' => 'required|is_unique[bahan_baku.id_bahan]',
        'nama_bahan' => 'required',
        'satuan' => 'required',
        'stok' => 'required|integer|greater_than[0]',
        'tanggal_masuk' => 'required|valid_date'
    ];

    public $bahanbakumasuk_errors = [
        'id_bahan' => [
            'required' => 'ID bahan wajib diisi.',
            'is_unique' => 'ID Bahan Baku sudah digunakan. Gunakan ID yang lain.'
        ],
        'nama_bahan' => [
            'required' => 'Nama bahan wajib diisi.'
        ],
        'satuan' => [
            'required' => 'Satuan bahan wajib diisi.'
        ],
        'stok' => [
            'required' => 'Stok bahan wajib diisi.',
            'integer' => 'Stok harus berupa angka.',
            'greater_than' => 'Stok harus lebih dari 0.'
        ],
        'tanggal_masuk' => [
            'required' => 'Tanggal masuk wajib diisi.',
            'valid_date' => 'Tanggal tidak valid.'
        ]
    ];
    
    public $bahanbakumasuk_edit = [
        'id_bahan' => 'required',
        'nama_bahan' => 'required',
        'satuan' => 'required',
        'stok' => 'required|integer|greater_than[0]',
        'tanggal_masuk' => 'required|valid_date'
    ];

    public $bahanbakumasuk_edit_errors = [
        'id_bahan' => [
            'required' => 'ID bahan wajib diisi.',
            'is_unique' => 'ID Bahan Baku sudah digunakan. Gunakan ID yang lain.'
        ],
        'nama_bahan' => [
            'required' => 'Nama bahan wajib diisi.'
        ],
        'satuan' => [
            'required' => 'Satuan bahan wajib diisi.'
        ],
        'stok' => [
            'required' => 'Stok bahan wajib diisi.',
            'integer' => 'Stok harus berupa angka.',
            'greater_than' => 'Stok harus lebih dari 0.'
        ],
        'tanggal_masuk' => [
            'required' => 'Tanggal masuk wajib diisi.',
            'valid_date' => 'Tanggal tidak valid.'
        ]
    ];    

    public $penjualan = [
        'id_penjualan' => 'required|is_unique[penjualan.id_penjualan]',
        'tanggal' => 'required|valid_date',
        'id_produk' => 'required',
        'jumlah' => 'required|integer|greater_than[0]',
        'satuan' => 'required'

    ];

    public $penjualan_errors = [
        'id_penjualan' => [
            'required' => 'ID penjualan wajib diisi.',
            'is_unique' => 'ID Penjualan sudah digunakan. Gunakan ID yang lain.'
        ],
        'tanggal' => [
            'required' => 'Tanggal penjualan wajib diisi.',
            'valid_date' => 'Tanggal tidak valid.'
        ],
        'id_produk' => [
            'required' => 'Produk wajib dipilih.'
        ],
        'jumlah' => [
            'required' => 'Jumlah wajib diisi.',
            'integer' => 'Jumlah harus berupa angka.',
            'greater_than' => 'Jumlah harus lebih dari 0.'
        ],
        'satuan' => [
            'required' => 'Satuan wajib diisi.'
        ]
    ];
    
}
